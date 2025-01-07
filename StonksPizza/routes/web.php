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
Route::get('/pizza/create', [PizzaController::class, 'create'])->name('pizza.create');

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
<<<<<<< HEAD

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

Route::get('/', function () {
    return view('Index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/order', function () {
    return view('order');
})->name('order');

=======
>>>>>>> ee00d6486cbe3cbb1a436ea103b6c97f4bd3f7e8
