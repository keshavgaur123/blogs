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
| Contact Form (FIXED)
|--------------------------------------------------------------------------
*/
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
