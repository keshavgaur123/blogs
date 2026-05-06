<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



// namespace App\Http\Controllers;

// use App\Models\Category;
// use Illuminate\Http\Request;

// class CategoryController extends Controller
// {
//     public function index()
//     {
//         $categories = Category::latest()->paginate(10);
//         return view('categories.index', compact('categories'));
//     }

//     public function create()
//     {
//         return view('categories.create');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         Category::create([
//             'name' => $request->name,
//         ]);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category created successfully');
//     }

//     public function edit(Category $category)
//     {
//         return view('categories.edit', compact('category'));
//     }

//     public function update(Request $request, Category $category)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         $category->update([
//             'name' => $request->name,
//         ]);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category updated successfully');
//     }

//     public function destroy(Category $category)
//     {
//         $category->delete();

//         return redirect()->route('categories.index')
//             ->with('success', 'Category deleted successfully');
//     }
// }


// class CategoryController extends Controller
// {
//     //  Page load (DataTable view only)
//     public function index()
//     {
//         return view('categories.index');
//     }

//     //  DataTables AJAX payload
//     public function data()
//     {
//         try {
//             $categories = Category::latest()->get();

//             return response()->json([
//                 'data' => $categories
//             ]);
//         } catch (\Exception $e) {

//             Log::error('Category DataTable Error: ' . $e->getMessage());

//             return response()->json([
//                 'message' => 'Failed to load categories',
//             ], 500);
//         }
//     }

//     public function create()
//     {
//         return view('categories.create');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         Category::create($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category created successfully');
//     }

//     public function edit(Category $category)
//     {
//         return view('categories.edit', compact('category'));
//     }

//     public function update(Request $request, Category $category)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         $category->update($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category updated successfully');
//     }

//     public function destroy(Category $category)
//     {
//         $category->delete();

//         return redirect()->route('categories.index')
//             ->with('success', 'Category deleted successfully');
//     }
// }




// class CategoryController extends Controller
// {
//     public function index()
//     {
//         return view('categories.index');
//     }

//     public function data()
//     {
//         try {
//             $categories = Category::latest()->get();

//             return response()->json([
//                 'data' => $categories
//             ]);
//         } catch (\Throwable $e) {

//             Log::error('Category DataTable Error: ' . $e->getMessage());

//             return response()->json([
//                 'data' => [],
//                 'message' => 'Failed to load categories'
//             ], 500);
//         }
//     }

//     public function create()
//     {
//         return view('categories.create');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         Category::create($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category created successfully');
//     }

//     public function edit(Category $category)
//     {
//         return view('categories.edit', compact('category'));
//     }

//     public function update(Request $request, Category $category)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//         ]);

//         $category->update($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category updated successfully');
//     }

//     public function destroy(Category $category)
//     {
//         $category->delete();

//         return redirect()->route('categories.index')
//             ->with('success', 'Category deleted successfully');
//     }
// }



class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function data()
    {
        try {
            return response()->json([
                'data' => Category::latest()->get()
            ]);
        } catch (\Throwable $e) {

            Log::error('Category Data Error: ' . $e->getMessage());

            return response()->json([
                'data' => []
            ], 500);
        }
    }
}
