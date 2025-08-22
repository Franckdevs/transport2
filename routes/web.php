<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GareController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\CompagniesController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\ReservationController;


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
    Route::get('/connexion', 'premierePage')->name('premierePage_nameS');
    Route::post('/login', 'login')->name('login');
    Route::get('/dashboard', 'dashboardbetro')->name('dashboard');
    Route::get('/dashboardcompagnie', 'dashboardcompagnie')->name('dashboardcompagnie_name');
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


Route::controller(BusController::class)->group(function () {
    Route::get('/bus', 'index')->name('compagnie.bus');
    Route::get('/bus/create', 'create')->name('bus.create');
    Route::post('/bus/store', 'store')->name('bus.store');
});
Route::controller(PersonelController::class)->group(function () {
    Route::get('/personnel', 'index')->name('personnel.index');
    Route::get('/personnel/create', 'create')->name('personnel.create');
    Route::post('/personnel/store', 'store')->name('personnel.store');
});
Route::controller(ChauffeurController::class)->group(function () {
    Route::get('/chauffeur', 'index')->name('chauffeur.index');
    Route::get('/chauffeur/create', 'create')->name('chauffeur.create');
    Route::post('/chauffeur/store', 'store')->name('chauffeur.store');
});

Route::controller(ItineraireController::class)->group(function () {
    Route::get('/itineraire', 'index')->name('itineraire.index');
    Route::get('/itineraire/create', 'create')->name('itineraire.create');
    Route::post('/itineraire/store', 'store')->name('itineraire.store');
    Route::get('/itineraire/{id}', 'show')->name('itineraire.show');
});
Route::controller(VoyageController::class)->group(function () {
    Route::get('/voyage', 'index')->name('voyage.index');
    Route::get('/voyage/create', 'create')->name('voyage.create');
    Route::post('/voyage/store', 'store')->name('voyage.store');
    Route::get('/voyage/{id}', 'show')->name('voyage.show');
});