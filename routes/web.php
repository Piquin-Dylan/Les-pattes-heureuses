<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin', function () {
    return view('components.pages.login');
});
Route::get('/dashboard', function () {
    return view('components.pages.dashboard');
});
