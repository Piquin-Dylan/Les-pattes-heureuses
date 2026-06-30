<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin', function () {
    return view('components.pages.login');
});
Route::get('/dashboard', function () {
    return view('components.pages.dashboard');
});

Route::get('/animals', function () {
    return view('components.pages.animalsList');
})->name('animals');
Route::get('/animals/create', function () {
    return view('components.pages.animals');
})->name('animals.create');
