<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\BlogController;
// use App\Http\Controllers\ContactController;

// /*
// |---------------------------
// | Home (Blog Listing)
// |---------------------------
// */

// Route::get('/', [BlogController::class, 'index'])->name('home');

// /*
// |---------------------------
// | Static Pages
// |---------------------------
// */
// Route::view('/about', 'pages.about')->name('about');
// Route::view('/contact', 'pages.contact')->name('contact');

// /*
// |---------------------------
// | Blog Routes
// |---------------------------
// */

// // Blog list (optional separate page)
// Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');

// // Blog detail (use controller, not closure)
// Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

// /*
// |---------------------------
// | Auth Pages
// |---------------------------
// */
// Route::view('/login', 'auth.login')->name('login');
// Route::view('/register', 'auth.register')->name('register');




// ==========================


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', [BlogController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');


/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Contact Form 
|--------------------------------------------------------------------------
*/
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD (IMPORTANT FIX)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


// Route::resource('categories', CategoryController::class)
//             ->except(['']);

/*
| Authenticated routes
*/
// Route::middleware('auth')->group(function () {
//     // Dashboard for authenticated users
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//     // Admin area (optional: protect with 'admin' middleware if you create it)
//     Route::prefix('admin')->name('admin.')->group(function () {
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//         Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
//         Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
//         Route::get('enquiries', [\App\Http\Controllers\Admin\EnquiryController::class, 'index'])->name('enquiries.index');
//     });
// });


























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