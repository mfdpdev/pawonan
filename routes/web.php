<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::middleware('auth')->group(function() {
    Route::get('/blogs', function () { return view('blogs.app'); })->name('blogs');
    Route::get('/blogs/create', function () { return view('blogs.create'); })->name('blogs.create');
    Route::get('/profiles', function () { return view('profiles.app'); })->name('profiles');
    Route::get('/auth/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/auth/signin', [AuthController::class, 'showSignInForm'])->name('signin');
    Route::post('/auth/signin', [AuthController::class, 'signin']);

    Route::get('/auth/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/auth/signup', [AuthController::class, 'signup']);
});


