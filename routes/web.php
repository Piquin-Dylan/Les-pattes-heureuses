<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('components.client.pages.accueil');
})->name('login');


Route::get('/admin', function () {
    return view('components.pages.login');
})->name('login');


Route::get('/animal/{animal}', function (\App\Models\Animal $animal) {
    return view('components.client.pages.animaux', [
        'animal' => $animal
    ]);
})->name('public.animals.show');

Route::get('adoption/{animal}', function (\App\Models\Animal $animal) {
    return view('components.client.pages.adoption', [
        'animal' => $animal
    ]);
})->name('public.adoption');


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
            'animal' => $animal
        ]);
    })->name('animals.show');

    Route::get('/animals/{animal}/edit', function (\App\Models\Animal $animal) {
        return view('components.pages.animals.animalEdit', [
            'animal' => $animal
        ]);
    })->name('animals.edit');

    Route::get('/members', function () {
        return view('components.pages.member.membersShow');
    })->name('members.show');

    Route::get('/members/create', function () {
        return view('components.pages.member.memberCreate');
    })->name('members.create');

    Route::get('/members/{member}', function (\App\Models\User $member) {
        return view('components.pages.member.memberFiche', [
            'member' => $member
        ]);
    })->name('members.fiche');

    Route::get('/adoption', function () {
        return view('components.pages.adoption.adoption_list', [
        ]);
    })->name('adoption');
});
