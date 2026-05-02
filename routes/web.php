<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';




// use Illuminate\Support\Facades\Route;

// /*
// |---------------------------
// | Static Pages
// |---------------------------
// */

// Route::view('/', 'pages.home')->name('home');
// Route::view('/about', 'pages.about')->name('about');
// Route::view('/contact', 'pages.contact')->name('contact');

// /*
// |---------------------------
// | Blog Routes
// |---------------------------
// */

// // Blog Listing
// Route::view('/blogs', 'pages.blogs')->name('blogs');

// // // Blog Details (Dynamic)
// // Route::get('/blogs/{id}', function ($id) {
// //     return view('pages.blog-details', compact('id'));
// // })->name('blog.details');



// Route::get('/blog/{id}', function ($id) {
//     return view('pages.view', ['id' => $id]);
// })->name('blog.view');

// /*
// |---------------------------
// | Auth Pages
// |---------------------------
// */

// Route::view('login', 'auth.login')->name('login');
// Route::view('register', 'auth.register')->name('register');



// ========================

// <?php

use Illuminate\Support\Facades\Route;

/*
|---------------------------
| Static Pages
|---------------------------
*/

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

/*
|---------------------------
| Blog Routes
|---------------------------
*/

// Blog Listing
Route::view('/blogs', 'pages.blogs')->name('blogs');

// // Blog Details (Dynamic)
// Route::get('/blogs/{id}', function ($id) {
//     return view('pages.blog-details', compact('id'));
// })->name('blog.details');



Route::get('/blog/{id}', function ($id) {
    return view('pages.view', ['id' => $id]);
})->name('blog.view');

/*
|---------------------------
| Auth Pages
|---------------------------
*/

Route::view('login', 'auth.login')->name('login');
Route::view('register', 'auth.register')->name('register');