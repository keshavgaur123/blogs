<?php



// namespace App\Http\Controllers;

// use App\Models\Category;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class CategoryController extends Controller
// {
//     // ================= LIST PAGE =================
//     public function index()
//     {
//         return view('categories.index');
//     }

//     // ================= DATATABLE DATA =================
//     public function data()
//     {
//         try {
//             $categories = Category::with('parent')
//                 ->latest()
//                 ->get();

//             return response()->json([
//                 'data' => $categories
//             ]);
//         } catch (\Throwable $e) {

//             Log::error('Category Data Error: ' . $e->getMessage());

//             return response()->json([
//                 'data' => [],
//                 'message' => 'Failed to load categories'
//             ], 500);
//         }
//     }

//     // ================= CREATE PAGE =================
//     public function create()
//     {
//         return view('categories.create');
//     }

//     // ================= STORE (PARENT + MULTIPLE SUBCATEGORIES) =================
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'subcategories' => 'nullable|array',
//         ]);

//         // 1. Create Parent Category
//         $parent = Category::create([
//             'name' => $request->name,
//             'parent_id' => null,
//         ]);

//         // 2. Create Subcategories
//         if (!empty($request->subcategories)) {
//             foreach ($request->subcategories as $sub) {
//                 if (!empty($sub)) {
//                     Category::create([
//                         'name' => $sub,
//                         'parent_id' => $parent->id,
//                     ]);
//                 }
//             }
//         }

//         return redirect()->route('categories.index')
//             ->with('success', 'Category with subcategories created successfully');
//     }

//     // ================= EDIT =================
//     public function edit(Category $category)
//     {
//         $categories = Category::whereNull('parent_id')
//             ->where('id', '!=', $category->id)
//             ->get();

//         return view('categories.edit', compact('category', 'categories'));
//     }

//     // ================= UPDATE =================
//     public function update(Request $request, Category $category)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'parent_id' => 'nullable|exists:categories,id',
//         ]);

//         $category->update([
//             'name' => $request->name,
//             'parent_id' => $request->parent_id,
//         ]);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category updated successfully');
//     }

//     // ================= DELETE =================
//     public function destroy(Category $category)
//     {
//         // Optional: delete children also
//         Category::where('parent_id', $category->id)->delete();

//         $category->delete();

//         return redirect()->route('categories.index')
//             ->with('success', 'Category deleted successfully');
//     }
// }


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index');
    }

    public function data()
    {
        $categories = Category::with('parent')->latest()->get();

        return response()->json([
            'data' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.create', compact('categories'));
    }

    // ✅ FIXED STORE (NO DUPLICATE, NO BUG)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subcategories' => 'nullable|array'
        ]);

        // Parent
        $parent = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => null
        ]);

        // Children
        if ($request->subcategories) {
            foreach ($request->subcategories as $sub) {
                if ($sub) {
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

    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('categories.edit', compact('category', 'categories'));
    }

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

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}


// namespace App\Http\Controllers;

// use App\Models\Category;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;



// // namespace App\Http\Controllers;

// // use App\Models\Category;
// // use Illuminate\Http\Request;

// // class CategoryController extends Controller
// // {
// //     public function index()
// //     {
// //         $categories = Category::latest()->paginate(10);
// //         return view('categories.index', compact('categories'));
// //     }

// //     public function create()
// //     {
// //         return view('categories.create');
// //     }

// //     public function store(Request $request)
// //     {
// //         $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         Category::create([
// //             'name' => $request->name,
// //         ]);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category created successfully');
// //     }

// //     public function edit(Category $category)
// //     {
// //         return view('categories.edit', compact('category'));
// //     }

// //     public function update(Request $request, Category $category)
// //     {
// //         $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         $category->update([
// //             'name' => $request->name,
// //         ]);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category updated successfully');
// //     }

// //     public function destroy(Category $category)
// //     {
// //         $category->delete();

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category deleted successfully');
// //     }
// // }


// // class CategoryController extends Controller
// // {
// //     //  Page load (DataTable view only)
// //     public function index()
// //     {
// //         return view('categories.index');
// //     }

// //     //  DataTables AJAX payload
// //     public function data()
// //     {
// //         try {
// //             $categories = Category::latest()->get();

// //             return response()->json([
// //                 'data' => $categories
// //             ]);
// //         } catch (\Exception $e) {

// //             Log::error('Category DataTable Error: ' . $e->getMessage());

// //             return response()->json([
// //                 'message' => 'Failed to load categories',
// //             ], 500);
// //         }
// //     }

// //     public function create()
// //     {
// //         return view('categories.create');
// //     }

// //     public function store(Request $request)
// //     {
// //         $validated = $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         Category::create($validated);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category created successfully');
// //     }

// //     public function edit(Category $category)
// //     {
// //         return view('categories.edit', compact('category'));
// //     }

// //     public function update(Request $request, Category $category)
// //     {
// //         $validated = $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         $category->update($validated);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category updated successfully');
// //     }

// //     public function destroy(Category $category)
// //     {
// //         $category->delete();

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category deleted successfully');
// //     }
// // }




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

//     // public function create()
//     // {
//     //     return view('categories.create');
//     // }



//     public function create()
//     {
//         $categories = Category::whereNull('parent_id')->get();

//         return view('categories.create', compact('categories'));
//     }




//     // public function store(Request $request)
//     // {
//     //     $validated = $request->validate([
//     //         'name' => 'required|string|max:255',
//     //     ]);

//     //     Category::create($validated);

//     //     return redirect()->route('categories.index')
//     //         ->with('success', 'Category created successfully');
//     // }


//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'parent_id' => 'nullable|exists:categories,id',
//         ]);

//         Category::create($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category created successfully');
//     }


//     // public function edit(Category $category)
//     // {
//     //     return view('categories.edit', compact('category'));
//     // }


//     // public function edit(Category $category)
//     // {
//     //     return view('categories.edit', compact('category'));
//     // }

//     public function edit(Category $category)
//     {
//         $categories = Category::whereNull('parent_id')
//             ->where('id', '!=', $category->id)
//             ->get();

//         return view('categories.edit', compact('category', 'categories'));
//     }





//     // public function update(Request $request, Category $category)
//     // {
//     //     $validated = $request->validate([
//     //         'name' => 'required|string|max:255',
//     //     ]);

//     //     $category->update($validated);

//     //     return redirect()->route('categories.index')
//     //         ->with('success', 'Category updated successfully');
//     // }



//     public function update(Request $request, Category $category)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'parent_id' => 'nullable|exists:categories,id',
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

// //for only test pepose table data are working or not 

// // class CategoryController extends Controller
// // {
// //     public function index()
// //     {
// //         return view('categories.index');
// //     }

// //     public function data()
// //     {
// //         try {
// //             return response()->json([
// //                 'data' => Category::latest()->get()
// //             ]);
// //         } catch (\Throwable $e) {

// //             Log::error('Category Data Error: ' . $e->getMessage());

// //             return response()->json([
// //                 'data' => []
// //             ], 500);
// //         }
// //     }
// // }




// namespace App\Http\Controllers;

// use App\Models\Category;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;



// // ================= OLD SIMPLE CRUD CONTROLLER =================

// // namespace App\Http\Controllers;

// // use App\Models\Category;
// // use Illuminate\Http\Request;

// // class CategoryController extends Controller
// // {
// //     public function index()
// //     {
// //         $categories = Category::latest()->paginate(10);
// //         return view('categories.index', compact('categories'));
// //     }

// //     public function create()
// //     {
// //         return view('categories.create');
// //     }

// //     public function store(Request $request)
// //     {
// //         $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         Category::create([
// //             'name' => $request->name,
// //         ]);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category created successfully');
// //     }

// //     public function edit(Category $category)
// //     {
// //         return view('categories.edit', compact('category'));
// //     }

// //     public function update(Request $request, Category $category)
// //     {
// //         $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         $category->update([
// //             'name' => $request->name,
// //         ]);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category updated successfully');
// //     }

// //     public function destroy(Category $category)
// //     {
// //         $category->delete();

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category deleted successfully');
// //     }
// // }



// // ================= OLD DATATABLE CONTROLLER =================

// // class CategoryController extends Controller
// // {
// //     // Page load (DataTable view only)
// //     public function index()
// //     {
// //         return view('categories.index');
// //     }

// //     // DataTables AJAX payload
// //     public function data()
// //     {
// //         try {
// //             $categories = Category::latest()->get();

// //             return response()->json([
// //                 'data' => $categories
// //             ]);
// //         } catch (\Exception $e) {

// //             Log::error('Category DataTable Error: ' . $e->getMessage());

// //             return response()->json([
// //                 'message' => 'Failed to load categories',
// //             ], 500);
// //         }
// //     }

// //     public function create()
// //     {
// //         return view('categories.create');
// //     }

// //     public function store(Request $request)
// //     {
// //         $validated = $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         Category::create($validated);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category created successfully');
// //     }

// //     public function edit(Category $category)
// //     {
// //         return view('categories.edit', compact('category'));
// //     }

// //     public function update(Request $request, Category $category)
// //     {
// //         $validated = $request->validate([
// //             'name' => 'required|string|max:255',
// //         ]);

// //         $category->update($validated);

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category updated successfully');
// //     }

// //     public function destroy(Category $category)
// //     {
// //         $category->delete();

// //         return redirect()->route('categories.index')
// //             ->with('success', 'Category deleted successfully');
// //     }
// // }






// // ================= CURRENT CONTROLLER WITH SUBCATEGORY =================

// class CategoryController extends Controller
// {

//     // ================= CATEGORY LIST PAGE =================
//     public function index()
//     {
//         return view('categories.index');
//     }



//     // ================= DATATABLE AJAX =================
//     public function data()
//     {
//         try {

//             // OLD CODE
//             // $categories = Category::latest()->get();

//             // NEW CODE WITH PARENT RELATION
//             $categories = Category::with('parent')
//                 ->latest()
//                 ->get();

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



//     // ================= CREATE PAGE =================

//     // OLD CODE
//     // public function create()
//     // {
//     //     return view('categories.create');
//     // }

//     // NEW CODE FOR SUBCATEGORY
//     public function create()
//     {
//         $categories = Category::whereNull('parent_id')->get();

//         return view('categories.create', compact('categories'));
//     }



//     // ================= STORE CATEGORY =================

//     // OLD CODE
//     // public function store(Request $request)
//     // {
//     //     $validated = $request->validate([
//     //         'name' => 'required|string|max:255',
//     //     ]);

//     //     Category::create($validated);

//     //     return redirect()->route('categories.index')
//     //         ->with('success', 'Category created successfully');
//     // }

//     // NEW CODE WITH SUBCATEGORY
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'parent_id' => 'nullable|exists:categories,id',
//         ]);

//         Category::create($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category created successfully');
//     }



//     // ================= EDIT PAGE =================

//     // OLD CODE
//     // public function edit(Category $category)
//     // {
//     //     return view('categories.edit', compact('category'));
//     // }

//     // NEW CODE WITH PARENT CATEGORY DROPDOWN
//     public function edit(Category $category)
//     {
//         $categories = Category::whereNull('parent_id')
//             ->where('id', '!=', $category->id)
//             ->get();

//         return view('categories.edit', compact('category', 'categories'));
//     }



//     // ================= UPDATE CATEGORY =================

//     // OLD CODE
//     // public function update(Request $request, Category $category)
//     // {
//     //     $validated = $request->validate([
//     //         'name' => 'required|string|max:255',
//     //     ]);

//     //     $category->update($validated);

//     //     return redirect()->route('categories.index')
//     //         ->with('success', 'Category updated successfully');
//     // }

//     // NEW CODE WITH SUBCATEGORY
//     public function update(Request $request, Category $category)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'parent_id' => 'nullable|exists:categories,id',
//         ]);

//         $category->update($validated);

//         return redirect()->route('categories.index')
//             ->with('success', 'Category updated successfully');
//     }



//     // ================= DELETE CATEGORY =================
//     public function destroy(Category $category)
//     {
//         $category->delete();

//         return redirect()->route('categories.index')
//             ->with('success', 'Category deleted successfully');
//     }
// }




// // ================= TEST CONTROLLER =================

// // for only test purpose table data are working or not

// // class CategoryController extends Controller
// // {
// //     public function index()
// //     {
// //         return view('categories.index');
// //     }

// //     public function data()
// //     {
// //         try {
// //             return response()->json([
// //                 'data' => Category::latest()->get()
// //             ]);
// //         } catch (\Throwable $e) {

// //             Log::error('Category Data Error: ' . $e->getMessage());

// //             return response()->json([
// //                 'data' => []
// //             ], 500);
// //         }
// //     }
// // }
