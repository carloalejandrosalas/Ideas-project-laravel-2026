<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Ideas resource routes.
Route::resource('ideas', IdeaController::class);
