<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::share(
            'navbarCategories',
            Category::with('children')
                ->whereNull('parent_id')
                ->get()
        );


        Paginator::useBootstrapFive();
    }
}
