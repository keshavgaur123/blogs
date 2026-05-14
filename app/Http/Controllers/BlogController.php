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
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = Str::slug($request->title);

        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        \Log::info('EVENT ABOUT TO FIRE');

        event(new NewBlogCreated($blog));

        return redirect()->route('blogs.index')
            ->with([
                'success' => 'Blog created successfully',
                'blog_title' => $blog->title,
                'blog_slug' => $blog->slug,
            ]);
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

    public function edit(Blog $blog)
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('blog.edit', compact('blog', 'categories'));
    }

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

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        /**
         * ❌ OLD WRONG USAGE (kept for reference)
         * event(new NewBlogCreated($blog));
         */

        /**
         * ❌ OLD WRONG MESSAGE (kept for reference)
         * return redirect()->route('blogs.index')
         *     ->with('success', 'Blog created successfully');
         */

        return redirect()->route('blogs.index')
            ->with([
                'success' => 'Blog deleted successfully',
                'blog_title' => $blog->title,
                'blog_slug' => $blog->slug,
            ]);
    }
}
