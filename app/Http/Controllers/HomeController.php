<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')
            ->latest()
            ->paginate(6); // adjust per row (6, 9, 12)

        $categories = Category::all();

        return view('pages.home', compact('blogs', 'categories'));
    }

    public function about()
    {
        return view('pages.about');
    }
}
