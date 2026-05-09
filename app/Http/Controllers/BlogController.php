<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // LIST PAGE
    public function index()
    {
        $blogs = Blog::with('category', 'user')
            ->latest()
            ->get();

        return view('blog.index', compact('blogs'));
    }

    // DATATABLE DATA
    public function data()
    {
        $blogs = Blog::latest()->get();

        return response()->json([
            'data' => $blogs
        ]);
    }

    // CREATE PAGE
    public function create()
    {
        $categories = Category::all();

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

    // SHOW
    public function show(Blog $blog)
    {
        $blog->load(['category', 'user']);

        $popularBlogs = Blog::with(['category', 'user'])
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    // EDIT (FIXED - THIS WAS YOUR MAIN ISSUE)
    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return view('blog.edit', compact('blog', 'categories'));
    }

    // UPDATE (FULL FIXED IMAGE HANDLING)
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

            // delete old image
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            // store new image
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
        // delete image too
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
