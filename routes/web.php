<?php

use App\Http\Controllers\CompagniesController;
use App\Http\Controllers\ConnexionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [ConnexionController::class, 'premierePage'])->name('premierePage_name');

Route::post('/login', [ConnexionController::class, 'login'])->name('login');

// Route::middleware('auth')->group(function () {
// Route::get('/dashboard', [ConnexionController::class, 'dashboard'])->name('dashboard');
// Route::post('/', [ConnexionController::class, 'logout'])->name('logout');
// // Route::get('/compagnies', [ConnexionController::class, 'compagnie'])->name('compagnies');

// //  Route::resources([
//     //  'compagnies' => CompagniesController::class
//     //  ]);

// });

Route::controller(ConnexionController::class)->group(function () {
Route::get('/connexion', 'premierePage')->name('premierePage_name');
Route::post('/login', 'login')->name('login');
Route::get('/dashboard', 'dashboard')->name('dashboard');
Route::post('/', 'logout')->name('logout');
});


Route::controller(CompagniesController::class)->group(function () {
Route::get('/compagnies', 'index')->name('compagnies');
Route::get('/compagnies/create', 'create')->name('compagnies.create');
Route::post('/compagnies/store', 'store')->name('compagnies.store');
Route::get('/compagnies-show/{compagnies}', 'show')->name('compagnies.show');
Route::get('/compagnies-edit/{compagnies}', 'edit')->name('compagnies.edit');

Route::post('compagnies-update/{compagnies}', 'update')->name('compagnies.update');
Route::get('/creer-acces/{id}', 'creerAcces')->name('creer.acces');

Route::put('/update-password/{id}', 'updatePassword')->name('acces.update.password');
});

// Route::post('update-compagnies/{compagnies}', [CompagniesController::class, 'update'])->name('compagnies.update');

