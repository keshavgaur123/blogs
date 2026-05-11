<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    // ================= LIST PAGE =================
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return view('categories.index', compact('categories'));
    }

    
    // ================= DATATABLE DATA =================
    public function data()
    {
        try {
            $categories = Category::with('parent')
                ->latest()
                ->get();

            return response()->json([
                'data' => $categories
            ]);
        } catch (\Throwable $e) {

            Log::error('Category Data Error: ' . $e->getMessage());

            return response()->json([
                'data' => [],
                'message' => 'Failed to load categories'
            ], 500);
        }
    }

    // ================= CREATE PAGE =================
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('categories.create', compact('categories'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subcategories' => 'nullable|array'
        ]);

        // Parent category
        $parent = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => null
        ]);

        // Subcategories
        if ($request->subcategories) {
            foreach ($request->subcategories as $sub) {
                if (!empty($sub)) {
                    Category::create([
                        'name' => $sub,
                        'slug' => Str::slug($sub),
                        'parent_id' => $parent->id
                    ]);
                }
            }
        }

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    // ================= EDIT =================
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('categories.edit', compact('category', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    // ================= DELETE =================
    public function destroy(Category $category)
    {
        // delete children first
        Category::where('parent_id', $category->id)->delete();

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
