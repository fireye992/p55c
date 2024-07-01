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
use App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;
use App\Livewire\ChatRoom;
use App\Livewire\Profile;
use App\Models\User;
use ChatRoom as GlobalChatRoom;

// Routes pour les invités (guest)
Route::middleware('guest')->group(function () {
    Route::get('/signin', function () {
        return view('account-pages.signin');
    })->name('signin');

    Route::get('/signup', function () {
        return view('account-pages.signup');
    })->name('signup');

    Route::get('/sign-up', [RegisterController::class, 'create'])->name('sign-up');
    Route::post('/sign-up', [RegisterController::class, 'store']);

    Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
    Route::post('/sign-in', [LoginController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store']);
});

// Routes pour les utilisateurs authentifiés (auth)
Route::middleware('auth')->group(function () {

    Route::get('/users', CreateChat::class)->name('users');
    Route::get('/chat{key?}', Main::class)->name('chat');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/users/{user}/message', [MessageController::class, 'send'])->name('users.message.send');
    Route::get('/profile.edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile.edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/medias', [MediasController::class, 'index'])->name('Medias');

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

    Route::post('/update-activity', [UserController::class, 'updateActivity']);

    Route::middleware('verified')->group(function () {
        Route::get('/chat-room/{recipientName}', ChatRoom::class)->name('chat-room');
        Route::post('/send-message/{slug}', [MessageController::class, 'send'])->name('message.send');
    });

    Route::middleware(IsAdmin::class)->group(function () {
        Route::resource('carousel', CarouselController::class);
    });

    Route::get('/profile', function () {
        return view('account-pages.profile');
    })->name('profile');
});

// Routes publiques
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/pages/{id}', [PageController::class, 'show'])->name('pages.show');
Route::get('/users/{slug}', [UserController::class, 'show'])->name('users.show');

Route::post('/follow/{slug}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{slug}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');
