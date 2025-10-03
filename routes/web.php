<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('posts.app');
})->middleware('auth')->name('dashboard');

Route::get('/auth/signin', [AuthController::class, 'showSignInForm'])->name('signin');
Route::post('/auth/signin', [AuthController::class, 'signin']);

Route::get('/auth/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
Route::post('/auth/signup', [AuthController::class, 'signup']);

Route::get('/auth/logout', [AuthController::class, 'logout']);
