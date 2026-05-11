<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // GLOBAL NAVBAR CATEGORIES (FIX YOUR ERROR)
        View::share(
            'navbarCategories',
            Category::with('children')
                ->whereNull('parent_id')
                ->get()
        );
    }
}
