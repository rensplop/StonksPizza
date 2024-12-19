<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;


Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pizzaria', function () {
    return view('Pizzaria.Index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\KlantController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\BestelregelController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;

Route::resource('klanten', KlantController::class);
Route::resource('bestellingen', BestellingController::class);
Route::resource('bestelregels', BestelregelController::class);
Route::resource('pizzas', PizzaController::class);
Route::resource('ingredients', IngredientController::class);

