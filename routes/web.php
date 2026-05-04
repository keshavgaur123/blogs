<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

/*
|---------------------------
| Home (Blog Listing)
|---------------------------
*/

Route::get('/', [BlogController::class, 'index'])->name('home');

/*
|---------------------------
| Static Pages
|---------------------------
*/
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

/*
|---------------------------
| Blog Routes
|---------------------------
*/

// Blog list (optional separate page)
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');

// Blog detail (use controller, not closure)
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

/*
|---------------------------
| Auth Pages
|---------------------------
*/
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
