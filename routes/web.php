<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchResultController;
use App\Livewire\Profile;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// Route::get('/search', [SearchController::class, 'index'])->name('search');
// Route::get('/search-result/{id}', [SearchResultController::class, 'show'])->name('search.result');
Route::get('/pages/{id}', [PageController::class, 'show'])->name('pages.show');
Route::get('/users/{name}', [UserController::class, 'show'])->name('users.show');

// Afficher le profil d'un utilisateur
// Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

// Suivre et ne plus suivre un utilisateur
Route::post('/follow/{name}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{name}', [FollowController::class, 'unfollow'])->name('unfollow');

// Messagerie
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/send/{name}', [MessageController::class, 'send'])->name('messages.send');


Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('carousel', CarouselController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile.edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile.edit', [Profile::class, 'edit'])->name('profile.edit');
    Route::put('/profile.edit', [ProfileController::class, 'update'])->name('profile.update');
    // Route::put('/profile.edit', [Profile::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/medias', [MediasController::class, 'index'])->name('Medias');
    
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/wallet', function () {
        return view('wallet');
    })->name('wallet');

    Route::get('/RTL', function () {
        return view('RTL');
    })->name('RTL');

    Route::get('utilisateur/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('utilisateur/user-profile/update', [ProfileController::class, 'update'])->name('users.update');
    Route::get('utilisateur/users-management', [UserController::class, 'index'])->name('users-management');
});

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');



Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');
  