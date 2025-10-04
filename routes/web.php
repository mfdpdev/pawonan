<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, ProfileController};


Route::middleware('auth')->group(function() {
    Route::get('/blogs', function () { return view('blogs.app'); })->name('blogs');
    Route::get('/blogs/create', function () { return view('blogs.create'); })->name('blogs.create');
    Route::get('/profiles', [ProfileController::class, "showProfilePage"])->name('profiles');
    Route::post('/profiles/updateProfile', [ProfileController::class, "updateProfile"])->name('updateProfile');
    Route::post('/profiles/updatePassword', [ProfileController::class, "updatePassword"])->name('updatePassword');
    Route::get('/auth/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function(){
    Route::get('/auth/signin', [AuthController::class, 'showSignInForm'])->name('signin');
    Route::post('/auth/signin', [AuthController::class, 'signin']);

    Route::get('/auth/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/auth/signup', [AuthController::class, 'signup']);
});


