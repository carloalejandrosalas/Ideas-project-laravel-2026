<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('/contact', function () {
        return view('pages.contact');
    })->name('contact');

    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

    /**
     * Auth routes
     */
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/**
 * Protected routes for authenticated users.
 */
Route::middleware('auth')->group(function () {
    Route::get('/account', [AuthController::class, 'showAccount'])->name('account');
    Route::put('/account', [AuthController::class, 'updateAuthenticatedUser'])->name('account.update');
    Route::put('/account/password', [AuthController::class, 'updatePassword'])->name('account.password.update');

    Route::resource('ideas', IdeaController::class);
    Route::get('ideas/{idea}/delete', [IdeaController::class, 'showDelete'])->name('ideas.showDelete');
});
