<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class Navbar extends Component
{
    public $categories;

    public function __construct()
    {
        $this->categories = Cache::remember('navbar_categories', 3600, function () {
            return Category::with('children')
                ->whereNull('parent_id')
                ->get();
        });
    }

    public function render()
    {
        return view('components.navbar');
    }
}
