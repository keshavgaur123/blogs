<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

/*
|---------------------------
| Home
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
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.view');

/*
|---------------------------
| Auth Routes
|---------------------------
*/
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');