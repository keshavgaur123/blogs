<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $postsCount = Blog::count();
        $categoriesCount = Category::count();
        $contactsCount = Contact::count();

        return view('admin.dashboard', compact('postsCount', 'categoriesCount', 'contactsCount'));
    }

    
}
