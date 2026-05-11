<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\HomeController;




// full category blog contact
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\BlogController;
// use App\Http\Controllers\ContactController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\BlogController as AdminBlogController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\EnquiryController;

// /*
// |--------------------------------------------------------------------------
// | Public Routes
// |--------------------------------------------------------------------------
// */

// // Home
// Route::get('/', [BlogController::class, 'dashboard'])->name('home');

// // Blogs (public)
// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
// Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

// // Static pages
// Route::view('/about', 'pages.about')->name('about');
// Route::view('/contact', 'pages.contact')->name('contact');

// // Contact form
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// /*
// |--------------------------------------------------------------------------
// | Authentication Routes
// |--------------------------------------------------------------------------
// */

// Route::middleware('guest')->group(function () {

//     Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
//     Route::post('/register', [RegisteredUserController::class, 'store']);

//     Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// });

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');


// /*
// |--------------------------------------------------------------------------
// | Authenticated Routes
// |--------------------------------------------------------------------------
// */

// Route::middleware('auth')->group(function () {

//     /*
//     |--------------------------------------------------------------------------
//     | Dashboard
//     |--------------------------------------------------------------------------
//     */
//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');

//     /*
//     |--------------------------------------------------------------------------
//     | Admin Panel
//     |--------------------------------------------------------------------------
//     */

//     Route::prefix('admin')->name('admin.')->group(function () {

//         // Admin dashboard
//         Route::get('/dashboard', [DashboardController::class, 'index'])
//             ->name('dashboard');

//         // Blog CRUD (Admin)
//         Route::resource('blogs', AdminBlogController::class);

//         // Categories
//         Route::resource('categories', CategoryController::class)
//             ->except(['show']);

//         // Enquiries
//         Route::get('enquiries', [EnquiryController::class, 'index'])
//             ->name('enquiries.index');
//     });
// });




// ==============================================



// Route::get('/', [BlogController::class, 'index'])->name('home');

// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
// Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

// Route::view('/about', 'pages.about')->name('about');
// Route::view('/contact', 'pages.contact')->name('contact');

// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::resource('categories', CategoryController::class);
//     Route::get('/categories-data', [CategoryController::class, 'data'])
//         ->name('categories.data');
// });

// Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
//     ->name('categories.edit');


// Route::get('/', [BlogController::class, 'index'])->name('home');

// // Route::get('/blog', [BlogController::class, 'index'])->name('blog');
// // Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');


// Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');

// Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');


// Route::view('/about', 'pages.about')->name('about');

// Route::view('/contact', 'pages.contact')->name('contact');

// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');

// Route::middleware('auth')->group(function () {

// //     Route::get('/categories-data', [CategoryController::class, 'data'])
// //         ->name('categories.data');

// //     Route::resource('categories', CategoryController::class);


// // });

//  // Categories
//     Route::resource('categories', CategoryController::class);

//     Route::get('/categories-data', [CategoryController::class, 'data'])
//         ->name('categories.data');

//     // Blogs CRUD
//     Route::resource('blog', BlogController::class);
// });



// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\BlogController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ContactController;
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES (HOME / ABOUT / CONTACT)
|--------------------------------------------------------------------------
*/

// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::view('/about', 'pages.about')->name('about');

// Route::get('/contact', function () {
//     return view('pages.contact');
// })->name('contact');

// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// /*
// |--------------------------------------------------------------------------
// | AUTH (LOGIN / REGISTER)
// |--------------------------------------------------------------------------
// */

// Route::middleware('guest')->group(function () {

//     Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
//     Route::post('/register', [RegisteredUserController::class, 'store']);

//     Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// });


// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');


// /*
// |--------------------------------------------------------------------------
// | DASHBOARD (ONLY AUTH USERS)
// |--------------------------------------------------------------------------
// */

// Route::middleware('auth')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');

//     Route::resource('categories', CategoryController::class);

//     Route::resource('blogs', BlogController::class);
// });




// /*
// |--------------------------------------------------------------------------
// | PUBLIC PAGES
// |--------------------------------------------------------------------------
// */

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/view-blog', [HomeController::class, 'viewBlog'])
//     ->name('view.blog');

// Route::get('/about', [HomeController::class, 'about'])->name('about');
// Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
// Route::get('/contact', function () {
//     return view('pages.contact');
// })->name('contact');

// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// /*
// |--------------------------------------------------------------------------
// | AUTH
// |--------------------------------------------------------------------------
// */

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');

// /*
// |--------------------------------------------------------------------------
// | DASHBOARD (AUTH ONLY)
// |--------------------------------------------------------------------------
// */

// Route::middleware('auth')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');

//     /*
//     |--------------------------------------------------------------------------
//     | BLOGS (IMPORTANT FIX)
//     |--------------------------------------------------------------------------
//     */

//     Route::resource('blogs', BlogController::class);
//     // Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');


//     Route::get('/blogs-data', [BlogController::class, 'data'])
//         ->name('blogs.data');

//     /*
//     |--------------------------------------------------------------------------
//     | CATEGORIES
//     |--------------------------------------------------------------------------
//     */

//     Route::resource('categories', CategoryController::class);

//     Route::get('/categories-data', [CategoryController::class, 'data'])
//         ->name('categories.data');
// });



/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

/*
|--------------------------------------------------------------------------
| CATEGORY / SUBCATEGORY BLOG PAGE
|--------------------------------------------------------------------------
|
| Example:
| /viewblog/laravel
| /viewblog/php
|
*/

// Route::get('/viewblog/{slug}', [BlogController::class, 'viewBlog'])
//     ->name('viewblog');
Route::get('/viewblog/{slug}', [BlogController::class, 'viewBlog'])
    ->name('viewblog');

    
    // Route::get('/blogs/filter', [BlogController::class, 'filterByCategory'])
    // ->name('blogs.filter');

    
/*
|--------------------------------------------------------------------------
| SINGLE BLOG PAGE
|--------------------------------------------------------------------------
*/

Route::get('/blog/{id}', [BlogController::class, 'show'])
    ->name('blog.show');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | BLOGS CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('blogs', BlogController::class);

    Route::get('/blogs-data', [BlogController::class, 'data'])
        ->name('blogs.data');

    /*
    |--------------------------------------------------------------------------
    | CATEGORIES CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class);

    Route::get('/categories-data', [CategoryController::class, 'data'])
        ->name('categories.data');
});