<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    // DATATABLE DATA
    public function data()
    {
        try {

            $blogs = Blog::latest()->get();

            return response()->json([
                'data' => $blogs
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'data' => [],
                'message' => 'Failed to load blogs'
            ], 500);
        }
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
        ]);

        Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog created successfully');
    }

    // SHOW
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    // EDIT
    public function edit(Blog $blog)
    {
        $categories = Category::all();

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
        ]);

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    // DELETE
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
