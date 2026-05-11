<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('category');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $blogs = $query->latest()->paginate(6);

        $categories = Category::all();

        return view('pages.home', compact('blogs', 'categories'));
    }

    public function about()
    {
        return view('pages.about');
    }
}
