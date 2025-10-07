<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, ProfileController, PostController};


Route::middleware('auth')->group(function() {

    Route::get('/blogs', [PostController::class, "showPostPage"])->name('posts');
    Route::get('/posts/create', [PostController::class, "showCreatePostPage"])->name('blogs.create');
    Route::get('/posts/update/{slug}', [PostController::class, "showUpdatePost"])->name('posts.update.form');

    Route::post('/posts', [PostController::class, "createPost"])->name('posts.create');
    Route::put('/posts/{slug}', [PostController::class, "updatePost"])->name('posts.update');

    Route::get('/profiles', [ProfileController::class, "showProfilePage"])->name('profiles');

    Route::post('/profiles/updateProfile', [ProfileController::class, "updateProfile"])->name('updateProfile');
    Route::post('/profiles/updatePassword', [ProfileController::class, "updatePassword"])->name('updatePassword');
    Route::post('/auth/signout', [AuthController::class, 'signout'])->name('signout');
});

Route::middleware('guest')->group(function(){
    Route::get('/auth/signin', [AuthController::class, 'showSignInForm'])->name('signin');
    Route::post('/auth/signin', [AuthController::class, 'signin']);

    Route::get('/auth/signup', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/auth/signup', [AuthController::class, 'signup']);
});


