<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin', function () {
    return view('components.pages.login');
});




Route::get('/dashboard', function () {
    return view('components.pages.dashboard');
});

Route::get('/animals', function () {
    return view('components.pages.animals.animalsList');
})->name('animals');

Route::get('/animals/create', function () {
    return view('components.pages.animals.animals');
})->name('animals.create');

Route::get('/animals/{id}', function () {
    return view('components.pages.animals.animalsShow');
})->name('animals.show');
