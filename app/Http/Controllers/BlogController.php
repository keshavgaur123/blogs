<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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





    // DATA
    public function data()
    {
        return response()->json([
            'data' => Blog::with('category')->latest()->get()
        ]);
    }

    // CREATE
    public function create()
    {
        // ONLY PARENT CATEGORIES
        $categories = Category::whereNull('parent_id')->get();

        return view('blog.create', compact('categories'));
    }

    // STORE
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'slug' => 'required|unique:blogs,slug',
    //         'content' => 'required',
    //         'category_id' => 'required|exists:categories,id',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     $imagePath = null;

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('blogs', 'public');
    //     }

    //     Blog::create([
    //         'title' => $request->title,
    //         'slug' => $request->slug,
    //         'content' => $request->content,
    //         'image' => $imagePath,
    //         'category_id' => $request->category_id,
    //         'user_id' => auth()->id(),
    //         'status' => 1,
    //     ]);

    //     return redirect()->route('blogs.index')
    //         ->with('success', 'Blog created successfully');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = Str::slug($request->title);

        // check duplicate slug
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully');
    }



    /*
    |--------------------------------------------------------------------------
    | OLD SHOW METHOD (ROUTE MODEL BINDING) - DISABLED
    |--------------------------------------------------------------------------
    */

    /*
    public function show(Blog $blog)
    {
        $blog->load(['category', 'user']);

        $popularBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }
    */

    /*
    |--------------------------------------------------------------------------
    | OLD SLUG METHOD - DISABLED
    |--------------------------------------------------------------------------
    */

    /*
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('blog'));
    }
    */

    /*
    |--------------------------------------------------------------------------
    | FINAL WORKING SHOW METHOD (USED BY ROUTE)
    |--------------------------------------------------------------------------
    */

    public function show($slug)
    {
        $blog = Blog::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $popularBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    // EDIT
    public function edit(Blog $blog)
    {
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
