<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\KlantController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\BestelregelController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoertuigController;

Route::resource('voertuigen', VoertuigController::class)->parameters([
    'voertuigen' => 'voertuig'
]);

Route::get('/menu', [PizzaController::class, 'index'])->name('menu.index');
Route::resource('pizza', PizzaController::class)->except(['index']);

Route::get('/menu', [PizzaController::class, 'index'])->name('menu.index');
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
    return view('pizzaria.index');
})->name('home');

Route::get('/about', function () {
    return view('About.Index');
})->name('about.index');

Route::get('/contact', function () {
    return view('Contact.Index');
})->name('contact.index');

Route::get('/mylogin', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('mylogin.index');
})->name('mylogin.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');



Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/mylogin');
})->name('logout');

require __DIR__.'/auth.php';
