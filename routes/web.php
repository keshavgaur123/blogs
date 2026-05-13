<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
// use App\Models\Category;
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
| CATEGORY BLOG FILTER (NAVBAR DROPDOWN)
|--------------------------------------------------------------------------
*/

Route::get('/category/{slug}/blogs', [CategoryController::class, 'blogs'])
    ->name('category.blogs');

/*
|--------------------------------------------------------------------------
| BLOG DETAIL PAGE (CARDS → SINGLE BLOG)
|--------------------------------------------------------------------------
*/


Route::get('/viewblog/{slug}', [BlogController::class, 'show'])
    ->name('viewblog');




/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {
    return view('pages.home'); // or wherever modal is included
})->name('contact');

Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.view');
Route::get('/contact/data', [ContactController::class, 'getContacts'])->name('contact.data');
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


// ========event notification routes=========== 

Route::post('/notifications/{id}/read', function ($id) {
    $user = auth()->user();
    if (! $user) {
        abort(403);
    }

    $notification = $user->notifications()->where('id', $id)->firstOrFail();
    $notification->markAsRead();

    return response()->json(['ok' => true]);
})->middleware('auth');


// Route::post('/notifications/{id}/read', function ($id) {
//     $user = auth()->user();
//     \DB::table('notifications')->where('id', $id)->where('notifiable_id', $user->id)->update(['read_at' => now()]);
//     return response()->json(['ok' => true]);
// })->middleware('auth');
