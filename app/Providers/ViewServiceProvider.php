<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::share('navbarCategories', Cache::remember('navbar_categories', 3600, function () {
            return Category::with('children')
                ->whereNull('parent_id')
                ->get();
        }));
    }
}
