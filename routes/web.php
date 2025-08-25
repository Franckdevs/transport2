<?php

use App\Http\Controllers\PersonelController;
use App\Http\Controllers\Voyage2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GareController;
use App\Http\Controllers\VoyageController;
// use App\Http\Controllers\PersonelController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\CompagniesController;
use App\Http\Controllers\AdminGareSetupController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\ReservationController;


// Route::get('/', [ConnexionController::class, 'premierePage'])->name('login');
Route::get('/login', [ConnexionController::class, 'logins'])->name('login');
Route::post('/', [ConnexionController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->group(function () {

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
Route::post('/login_connexion', 'login')->name('login_connexion');
Route::get('/dashboard', 'dashboardbetro')->name('dashboard');
Route::get('/dashboardcompagnie', 'dashboardcompagnie')->name('dashboardcompagnie_name');
// Route::post('/', 'logout')->name('logout');
    // Route::get('/connexion', 'premierePage')->name('premierePage_nameS');
    // Route::post('/login', 'login')->name('login');
    // Route::get('/dashboard', 'dashboardbetro')->name('dashboard');
    // Route::get('/dashboardcompagnie', 'dashboardcompagnie')->name('dashboardcompagnie_name');
    // Route::post('/', 'logout')->name('logout');
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

// Route::controller(GareController::class)->group(function () {

// Route::get('/gares', 'index2')->name('gares.index');
// Route::get('/gares/create', 'create2')->name('gares.create');
// Route::post('/gares/store', 'store2')->name('gares.store');
// Route::post('/gares-ajouterbUS/{gares}', 'ajouterbUS')->name('gares.ajouterbUS');

// Route::get('/gares-show/{gares}', 'show')->name('gares.show');

// });

// Route::middleware('auth')->group(function () {


// });

    Route::controller(GareController::class)->group(function () {
        Route::get('/gares', 'index2')->name('gares.index.2');
        Route::get('/gares/create', 'create2')->name('gares.create');
        Route::post('/gares/store', 'store2')->name('gares.store');
        Route::post('/gares-ajouterbUS/{gares}', 'ajouterbUS')->name('gares.ajouterbUS');
        Route::get('/gares-show/{gares}', 'show')->name('gares.show');
});


Route::controller(BusController::class)->group(function () {
Route::get('/bus-liste','index')->name('liste.bus');
Route::get('/bus/{bus}', 'show')->name('bus.show');
Route::get('/bus-edit/{bus}', 'edit')->name('bus.edit');
Route::post('/bus-update/{bus}', 'update')->name('bus.update');

// Route::controller(BusController::class)->group(function () {
    Route::get('/bus', 'index')->name('compagnie.bus');
    Route::get('/bus-create', 'create')->name('bus.create');
    Route::post('/bus/store', 'store')->name('bus.store');
});

Route::post('/bus/destroy/{bus}', [BusController::class, 'destroy'])->name('bus.destroy');


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

Route::controller(Voyage2Controller::class)->group(function () {
Route::get('/voyages','index')->name('voyages.index');

});

Route::post('/itineraires', [Voyage2Controller::class, 'store_itineraire'])->name('itineraires.store');

// Routes pour la configuration des administrateurs de gare
Route::get('/admin-gare/setup/{user}', [AdminGareSetupController::class, 'showSetupForm'])
    ->name('admin.gare.setup-password');
Route::post('/admin-gare/setup/{user}', [AdminGareSetupController::class, 'setupPassword'])
    ->name('admin.gare.setup-password.store');

// Route::post('update-compagnies/{compagnies}', [CompagniesController::class, 'update'])->name('compagnies.update');
// Route::resource('bus', BusController::class);
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

});
