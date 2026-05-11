<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // LIST
    public function index()
    {
        $blogs = Blog::with('category', 'user')
            ->latest()
            ->get();

        return view('blog.index', compact('blogs'));
    }



    //filter method
    // public function filterByCategory(Request $request)
    // {
    //     $blogs = Blog::with('category', 'user')
    //         ->when($request->category, function ($query) use ($request) {
    //             $query->where('category_id', $request->category);
    //         })
    //         ->latest()
    //         ->get();

    //     return view('pages.viewblog', compact('blog'));
    // }



    public function viewBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('pages.viewblog', [
            'blog' => $blog,
            'blogs' => null,
            'category' => null,
            'popularPosts' => Blog::latest()->take(5)->get(),
        ]);
    }

    public function categoryBlogs($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $blogs = Blog::with('category')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(9);

        return view('pages.viewblog', [
            'blogs' => $blogs,
            'blog' => null,
            'category' => $category,
            'popularPosts' => Blog::latest()->take(5)->get(),
        ]);
    }


    // public function viewBlog($slug)
    // {
    //     $blogs = Blog::with('category')
    //         ->latest()
    //         ->paginate(9);

    //     $popularPosts = Blog::latest()
    //         ->take(5)
    //         ->get();

    //     $blog = Blog::where('slug', $slug)->firstOrFail();

    //     return view('pages.viewblog', compact('blogs', 'popularPosts', 'blog'));
    // }
    // // DATA
    public function data()
    {
        return response()->json([
            'data' => Blog::with('category')->latest()->get()
        ]);
    }

    // CREATE
    public function create()
    {
        // ✅ ONLY PARENT CATEGORIES (IMPORTANT FIX)
        $categories = Category::whereNull('parent_id')->get();

        return view('blog.create', compact('categories'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully');
    }

    //view






    // SHOW
    public function show(Blog $blog)
    {
        $blog->load(['category', 'user']);

        $popularBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    // EDIT
    public function edit(Blog $blog)
    {
        // ✅ ONLY PARENT CATEGORIES
        $categories = Category::whereNull('parent_id')->get();

        return view('blog.edit', compact('blog', 'categories'));
    }

    // UPDATE
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $blog->id,
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {

            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    // DELETE
    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
