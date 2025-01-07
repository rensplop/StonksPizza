<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\KlantController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\BestelregelController;
use App\Http\Controllers\IngredientController;

// List all pizzas at /menu
Route::get('/menu', [PizzaController::class, 'index'])->name('menu.index');  

// Show create form
Route::get('/pizza/create', [PizzaController::class, 'create'])->name('pizza.create');

// Resource routes for pizza, except the index
Route::resource('pizza', PizzaController::class)->except(['index']);

// Other resource routes
Route::resource('klanten', KlantController::class);
Route::resource('bestellingen', BestellingController::class);
Route::resource('bestelregels', BestelregelController::class);
Route::resource('ingredients', IngredientController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// (Be aware that you have two “/” routes defined; 
//  Laravel will only use the second one you list.)
Route::get('/', function () {
    return view('home');
});

Route::get('/', function () {
    return view('pizzaria.index');  
});

Route::get('/about', function () {
    return view('About.Index');
})->name('about.index');

Route::get('/contact', function () {
    return view('Contact.Index');
})->name('contact.index');




require __DIR__.'/auth.php';
