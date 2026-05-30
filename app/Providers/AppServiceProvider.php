<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
        // Bootstrap pagination (Bootstrap 5)
        Paginator::useBootstrapFive();

        // Share navbar categories globally (safe + cache + correct structure)
        View::composer('*', function ($view) {

            Cache::forget('navbar_categories'); 

            $navbarCategories = Category::with('children')
                ->whereNull('parent_id')
                ->get();

            $view->with('navbarCategories', $navbarCategories);
        });
    }
}
