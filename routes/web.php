<?php

use Illuminate\Support\Facades\Route;


Route::get('/admin', function () {
    return view('components.pages.login');
})->name('login');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('components.pages.dashboard');
    });

    Route::get('/animals', function () {
        return view('components.pages.animals.animalsList');
    })->name('animals');

    Route::get('/animals/create', function () {
        return view('components.pages.animals.animals');
    })->name('animals.create');

    Route::get('/animals/{animal}', function (\App\Models\Animal $animal) {
        return view('components.pages.animals.animalsShow', [
            "animal" => $animal
        ]);
    })->name('animals.show');

    Route::get('/members', function () {
        return view('components.pages.member.membersShow', [
        ]);
    })->name('members.show');


    Route::get('/members/{member}', function (\App\Models\User $member) {
        return view('components.pages.member.memberFiche', [
            "member" => $member
        ]);
    })->name('members.fiche');
});
