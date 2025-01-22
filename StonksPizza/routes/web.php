<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\KlantController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\BestelregelController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoertuigController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('voertuigen', VoertuigController::class)->parameters([
    'voertuigen' => 'voertuig'
]);


Route::get('/bestellingen', [BestellingController::class, 'index'])->name('bestellingen.index');
Route::post('/bestellingen', [BestellingController::class, 'store'])->name('bestellingen.store');
Route::delete('/bestelregel/{regel}', [BestellingController::class, 'destroyRegel'])->name('bestellingen.destroyRegel');

Route::get('/status', [BestellingController::class, 'statusIndex'])->name('status.index');
Route::patch('/status/annuleer/{id}', [BestellingController::class, 'annuleer'])->name('status.annuleer');
Route::patch('/status/update/{id}', [BestellingController::class, 'updateStatus'])->name('status.updateStatus');


Route::resource('bestellingen', BestellingController::class);

Route::delete('/bestelregel/{regel}', [BestellingController::class, 'destroyRegel'])
    ->name('bestellingen.destroyRegel');

Route::get('/status', [BestellingController::class, 'statusIndex'])->name('status.index');

Route::patch('/status/annuleer/{id}', [BestellingController::class, 'annuleer'])
    ->name('status.annuleer');

Route::patch('/status/update/{id}', [BestellingController::class, 'updateStatus'])
    ->name('status.updateStatus');

Route::resource('bestellingen', BestellingController::class);

Route::delete('/bestelregel/{regel}', [BestellingController::class, 'destroyRegel'])
    ->name('bestellingen.destroyRegel');

Route::get('/menu', [PizzaController::class, 'index'])->name('menu.index');
Route::get('/pizza/create', [PizzaController::class, 'create'])->name('pizza.create');
Route::resource('pizza', PizzaController::class)->except(['index']);

Route::resource('klanten', KlantController::class);
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
