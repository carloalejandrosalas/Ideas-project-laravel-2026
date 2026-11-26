<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

/**
 * Only available for unauthenticated users.
 */
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('pages.welcome');
    })->name('welcome');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/reset-password', [AuthController::class, 'showPasswordReset'])->name('request.reset');
    Route::post('/reset-password', [AuthController::class, 'sendPasswordResetLink'])->name('request.password.link');
    Route::get('/new-password/{token}', [AuthController::class, 'showNewPasswordForm'])->name('request.password.new');
    Route::post('/new-password', [AuthController::class, 'newPassword'])->name('password.update');
});

/**
 * Protected routes for authenticated users.
 */
Route::middleware('auth')->group(function () {
    Route::get('/home', [IdeaController::class, 'index'])->name('home');

    Route::get('/account', [AuthController::class, 'showAccount'])->name('account');
    Route::put('/account', [AuthController::class, 'updateAuthenticatedUser'])->name('account.update');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('account.password.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('ideas', IdeaController::class)->except(['index']);
    Route::get('ideas/{idea}/delete', [IdeaController::class, 'showDelete'])->name('ideas.showDelete');
});

// Public pages routes
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('*', function () {
    return redirect()->route('welcome');
});
