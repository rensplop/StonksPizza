<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\KlantController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\BestelregelController;
use App\Http\Controllers\IngredientController;

Route::get('/menu', [PizzaController::class, 'index'])->name('menu.index');  // Shows all pizzas

Route::resource('pizza', PizzaController::class)->except(['index']);

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

Route::get('/', function () {
    return view('home');
});

Route::get('/', function () {
    return view('pizzaria.index');  
});


require __DIR__.'/auth.php';
