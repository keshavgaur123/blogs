<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/blog/{slug}', [BlogController::class, 'show'])
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

// Route::middleware('guest')->group(function () {

//     Route::get('/register', [RegisteredUserController::class, 'create'])
//         ->name('register');

//     Route::post('/register', [RegisteredUserController::class, 'store']);

//     Route::get('/login', [AuthenticatedSessionController::class, 'create'])
//         ->name('login');

//     Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// });

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth')
//     ->name('logout');


// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// show verification page
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// handle click on email link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// resend email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

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


Route::get('/notifications', [NotificationController::class, 'index'])
    ->middleware('auth')
    ->name('notifications');


Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
    ->middleware('auth')
    // FIX: renamed route name from "notifications.toasts" (misleading)
    ->name('notifications.readAll');


Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');


Route::patch('/profile/update', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::get('/notification/open/{id}', [NotificationController::class, 'open'])
    ->name('notifications.open');

require __DIR__ . '/auth.php';
