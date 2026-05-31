<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Events\NewBlogCreated;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'user')
            ->latest()
            ->get();

        return view('blog.index', compact('blogs'));
    }

    public function data()
    {
        return response()->json([
            'data' => Blog::with('category')->latest()->get()
        ]);
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // safe slug
        $slug = Str::slug($request->title);
        $base = $slug;
        $i = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('blogs', 'public')
            : null;

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        event(new NewBlogCreated($blog));

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully');
    }


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

    public function openFromNotification($slug)
    {
        // FIX: ensure clean slug (prevents spaces or wrong values from notification)
        $slug = trim($slug);

        $blog = Blog::with(['category', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $popularBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        $categories = Category::whereNull('parent_id')->get();

        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $base = $slug;
        $i = 1;

        while (
            Blog::where('slug', $slug)
            ->where('id', '!=', $blog->id)
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $blog->image,
            'category_id' => $request->category_id,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
