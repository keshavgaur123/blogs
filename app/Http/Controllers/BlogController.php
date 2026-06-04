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
        $blogs = Blog::select('id', 'title', 'slug', 'image', 'category_id', 'user_id', 'created_at')
            ->with([
                'category:id,name',
                'user:id,name'
            ])
            ->latest()
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    // public function data()
    // {
    //     return response()->json([
    //         'data' => Blog::select('id', 'title', 'slug', 'image', 'category_id', 'user_id', 'created_at')
    //             ->with(['category:id,name'])
    //             ->latest()
    //             ->paginate(10)
    //     ]);
    // }


    public function data()
    {
        return response()->json([
            'data' => Blog::select('id', 'title', 'content', 'slug', 'image', 'category_id', 'user_id', 'created_at')
                ->with(['category:id,name,parent_id'])
                ->latest()
                ->get()
        ]);
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->select('id', 'name')
            ->get();

        return view('blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=300,min_height=300'
            ],
        ]);

        $slug = $this->generateUniqueSlug($validated['title']);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            if (!$file->isValid()) {
                abort(422, 'Invalid image upload');
            }

            $imagePath = $file->store('blogs', 'public');
        }

        $blog = Blog::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'image' => $imagePath,
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        event(new NewBlogCreated($blog));

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog created successfully');
    }

    public function show($slug)
    {
        $blog = $this->getBlogBySlug($slug);

        $popularBlogs = Blog::select('id', 'title', 'slug', 'image')
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    public function openFromNotification($slug)
    {
        $blog = $this->getBlogBySlug(trim($slug));

        $popularBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'popularBlogs'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        $categories = Category::whereNull('parent_id')
            ->select('id', 'name')
            ->get();

        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=300,min_height=300'
            ],
            'status' => ['nullable', 'integer']
        ]);

        $slug = $this->generateUniqueSlug($validated['title'], $blog->id);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $file = $request->file('image');

            if (!$file->isValid()) {
                abort(422, 'Invalid image upload');
            }

            $imagePath = $file->store('blogs', 'public');
        }

        $blog->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'image' => $imagePath,
            'category_id' => $validated['category_id'],
            'status' => $validated['status'] ?? 1,
        ]);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog deleted successfully');
    }

    /**
     * 🔐 Safe slug generator (collision safe)
     */
    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while (
            Blog::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * 🔐 Central blog fetch (DRY + safer)
     */
    private function getBlogBySlug(string $slug): Blog
    {
        return Blog::with(['category:id,name', 'user:id,name'])
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
