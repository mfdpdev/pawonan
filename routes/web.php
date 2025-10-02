<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/auth/signin', function () {
    return view('auth.signin');
});

Route::get('/auth/signup', function () {
    return view('auth.signup');
});
