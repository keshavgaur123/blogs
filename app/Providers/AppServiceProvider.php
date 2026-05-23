<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paginator::useBootstrapFive();

        // View::composer('*', function ($view) {
        //     $navbarCategories = cache()->remember('navbar_categories', 3600, function () {
        //         return Category::with('children')
        //             ->whereNull('parent_id')
        //             ->get();
        //     });

        //     $view->with('navbarCategories', $navbarCategories);
        // });

        View::share(
            'navbarCategories',
            Category::with('children')
                ->whereNull('parent_id')
                ->get()
        );


        Paginator::useBootstrapFive();
    }
}
