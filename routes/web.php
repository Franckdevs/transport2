<?php

use App\Http\Controllers\ConfigurationBusController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\Voyage2Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\GareController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\TarificationController;
// use App\Http\Controllers\PersonelController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\CompagniesController;
use App\Http\Controllers\AdminGareSetupController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\PaiementTransactionController;
use App\Http\Controllers\ParamettreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ReservationTicketController;
use App\Http\Controllers\CompanyRegisterController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ConfigWebMobileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ModifierAdminGareController;
use App\Http\Controllers\PaiementController;

// Route::get('/', [ConnexionController::class, 'premierePage'])->name('login');
Route::get('/login', [ConnexionController::class, 'logins'])->name('login');
Route::post('/logout', [ConnexionController::class, 'logout'])->name('logout');
Route::post('/', [ConnexionController::class, 'logout'])->name('page_connexion');
Route::get('status-paiement/{code}', [PaiementController::class,'status_paiement'])->name('status_paiement');

Route::get('erreur-paiement', function() {
    return view('erreur_paiement');
})->name('erreur_paiement');
// Route::get('/', function () {
//     return redirect()->route('login');
// });
Route::get('/', [ConnexionController::class, 'acceuil'])->name('connexion');

// Route::get('/', function () {
//     return view('acceuil.acceuil');
// });

Route::get('/agent_email', function () {
    return view('emails.agents.status-changed');
});
//envoyer des message 
Route::post('/contact', [ContactController::class, 'create'])->name('contact.create');
// Public registration routes
Route::get('/register', [CompanyRegisterController::class, 'show'])->name('register');
Route::post('/register', [CompanyRegisterController::class, 'store'])->name('register.store');

// Password reset routes
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/mot-de-passe-oublie', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/mot-de-passe/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/mot-de-passe/reset', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');

    //sds
    // Password reset routes
Route::get('/mot-de-passe-oublie', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/mot-de-passe/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Nouvelle route pour la vérification OTP
Route::get('/verification-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])
    ->name('password.verify.otp.form');

Route::post('/verification-otp', [ForgotPasswordController::class, 'verifyOtp'])
    ->name('password.verify.otp');

Route::get('/mot-de-passe/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/mot-de-passe/reset', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/register/pending/{id?}',[CompanyRegisterController::class, 'pending'])->name('register.pending');

// Route::middleware('auth')->group(function () {
// Route::get('/dashboard', [ConnexionController::class, 'dashboard'])->name('dashboard');
// Route::post('/', [ConnexionController::class, 'logout'])->name('logout');
// // Route::get('/compagnies', [ConnexionController::class, 'compagnie'])->name('compagnies');

// //  Route::resources([
//     //  'compagnies' => CompagniesController::class
//     //  ]);

// });

Route::post('/login_connexion', [ConnexionController::class, 'login'])->name('login_connexion');

Route::get('/creer-acces/{id}', [CompagniesController::class, 'creerAcces'])->name('creer.acces');

Route::put('/update-password/{id}', [CompagniesController::class, 'updatePassword'])->name('acces.update.password');

    // Route::get('/reservation', [CompagniesController::class, 'index'])->name('reservation.index');

Route::middleware(['auth'])->group(function () {

Route::controller(ConnexionController::class)->group(function () {
Route::get('/connexion', 'premierePage')->name('premierePage_nameS');
// Route::post('/login_connexion', 'login')->name('login_connexion');
Route::get('/dashboard', 'dashboardbetro')->name('dashboard');

Route::get('/dashboardcompagnie', 'dashboardcompagnie')->name('dashboardcompagnie_name');
// Route::post('/', 'logout')->name('logout');
    // Route::get('/connexion', 'premierePage')->name('premierePage_nameS');
    // Route::post('/login', 'login')->name('login');
// Route::get('/dashboard', 'dashboardbetro')->name('betro.dashboard');
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
    Route::delete('/compagnies/{id}', 'destroy')->name('compagnies.destroy');
    Route::post('/compagnies/{id}/reactivate', 'reactiver_supprimer')->name('compagnies.reactivate');
    // Validation/refus des demandes (status == 2)
    Route::post('/compagnies/{id}/approve', 'approve')->name('compagnies.approve');
    Route::post('/compagnies/{id}/refuse', 'refuse')->name('compagnies.refuse');
    Route::post('/compagnies/{id}/update-logo', 'updateLogo')->name('compagnies.update-logo');
    // Route::get('/creer-acces/{id}', 'creerAcces')->name('creer.acces');
    // Route::put('/update-password/{id}', 'updatePassword')->name('acces.update.password');
});

// Routes pour la gestion des administrateurs de gares
Route::controller(ModifierAdminGareController::class)->group(function () {
    Route::get('/modifier-admin-gare', 'index')->name('modifier_admin_gare.index');
    Route::get('/modifier-admin-gare-modifier/{gareId}', 'edit')->name('modifier_admin_gare.edit');
    Route::post('/modifier-admin-gare-modifier-action/{gareId}/update', 'update')->name('modifier_admin_gare.update');
    Route::delete('/modifier-admin-gare/{gareId}/{adminId}/destroy', 'destroy')->name('modifier_admin_gare.destroy');
    Route::post('/modifier-admin-gare/{gareId}/{adminId}/deactivate', 'deactivate')->name('modifier_admin_gare.deactivate');
    Route::post('/modifier-admin-gare/{gareId}/{adminId}/activate', 'activate')->name('modifier_admin_gare.activate');
});

// Paiement Routes
Route::controller(PaiementTransactionController::class)->group(function () {
    Route::get('/paiements', 'index')->name('paiement.index');
    Route::get('/paiements_details/{id}','show')->name('paiement.show');
});

Route::controller(ReservationTicketController::class)->group(function () {
    Route::get('/ticket-reservation','index')->name('ticket_reservation.index');
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
    Route::post('/destroy_desactiver/{gares}', 'destroy_desactiver')->name('gares.destroy_desactiver');
    Route::post('/destroy_reactivation/{gares}', 'destroy_reactivation')->name('gares.destroy_reactivation');
    Route::get('/gares-modifier/{id}', 'edit')->name('gares.edit');
    Route::put( '/update2-gare/{id}', 'update2')->name('gares.update2');
});


Route::controller(BusController::class)->group(function () {
    Route::get('/bus-liste','index')->name('liste.bus');
    Route::get('/bus/{bus}', 'show')->name('bus.show');
    Route::get('/bus-edit/{bus}', 'edit')->name('bus.edit');
    Route::post('/bus-update/{bus}', 'update')->name('bus.update');
    Route::get('/bus', 'index')->name('compagnie.bus');
    Route::get('/bus-create', 'create')->name('bus.create');
    Route::post('/bus/store', 'store')->name('bus.store');
});

// Routes pour la gestion des classes
    // Routes pour les classes
    // Route::prefix('classes')->controller(ClasseController::class)->group(function () {
        Route::controller(ClasseController::class)->group(function () {

        Route::get('/classes', 'index')->name('classe.index');
        Route::get('/classes/create', 'create')->name('classe.create');
        Route::post('/classes/store', 'store')->name('classe.store');
        Route::get('/classes-show/{classe}', 'show')->name('classe.show');
        Route::get('/classes-edit/{classe}', 'edit')->name('classe.edit');
        Route::put('/classes-update/{classe}', 'update')->name('classe.update');
        Route::delete('/classes-destroy/{classe}', 'destroy')->name('classe.destroy');
        // Route pour le basculement du statut
        Route::put('/classes/{classe}/toggle-status', 'toggleStatus')->name('classe.toggle-status');
    });

// Route::put('compagnie/classes/{classe}/status', [ClasseController::class, 'updateStatus'])
//     ->name('classe.status');

Route::post('/bus/destroy_reactivation/{id}', [BusController::class, 'destroy_reactivation'])->name('activation.bus');

Route::post('/bus/destroy/{bus}', [BusController::class, 'destroy'])->name('bus.destroy');

Route::controller(PersonelController::class)->group(function () {
    Route::get('/personnel', 'index')->name('personnel.index');
    Route::get('/personnel/create', 'create')->name('personnel.create');
    Route::post('/personnel/store', 'store')->name('personnel.store');
    Route::get('/personnel-show/{id}', 'show')->name('personnel.show'); // ✅ ici});
    Route::get('edit/{id}', 'edit')->name('personnel.edit');
    Route::put('update/{id}', 'update')->name('personnel.update');
});

// Suppression (désactivation) du personnel
Route::delete('/personnel/{id}', [PersonelController::class, 'destroy'])->name('personnel.destroy');

// Réactivation du personnel
Route::put('/personnel/{id}/reactiver', [PersonelController::class, 'destroy_reactivation'])->name('personnel.reactivation');

Route::controller(ChauffeurController::class)->group(function () {
    Route::get('/chauffeur', 'index2')->name('chauffeur.index');
    Route::get('/chauffeur/create', 'create')->name('chauffeur.create');
    Route::post('/chauffeur/store', 'store')->name('chauffeur.store');
    Route::get('/edit-modifier/{id}', 'edit')->name('modifier.edit');
    Route::post('update/{id}', 'update')->name('modifier.update');
    Route::get('show/{id}', 'show')->name('voir.show');
    Route::post('destroy/{id}', 'destroy')->name('activer.destroy');
    Route::post('destroy_reactivation/{id}', 'destroy_reactivation')->name('activer.destroy_reactivation');
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
// Route pour récupérer les détails d'un bus
Route::get('/api/bus/{id}/details', [VoyageController::class, 'getBusDetails'])->name('api.bus.details');

Route::controller(ItineraireController::class)->group(function () {
    Route::get('/itineraire', 'index')->name('itineraire.index');
    Route::get('/itineraire/create', 'create')->name('itineraire.create');
    Route::post('/itineraire/store', 'store')->name('itineraire.store');
    Route::get('/itineraire-details/{id}', 'show')->name('itineraire.show');
    Route::delete('/itineraire/{id}/destroy', 'destroy')->name('itineraire.destroy');
    Route::put('/itineraire/{id}/reactivation', 'destroy_reactivation')->name('itineraire.reactivation');
    Route::get('/itineraire-update-route/{id}', 'edit')->name('itineraire.edit');
    Route::put('/itineraire-update/{id}', 'update')->name('itineraire.update');
});

Route::get('/gares/{id}', [App\Http\Controllers\ItineraireController::class, 'details']);


// Routes pour la gestion des tarifications
// Route::controller(TarificationController::class)->prefix('tarification')->name('tarification.')->group(function () {
//     Route::get('liste-tarification', 'index')->name('index');
//     Route::get('create', 'create')->name('create');
//     Route::post('store', 'store')->name('store');
//     Route::get('{tarification}', 'show')->name('show');
//     Route::get('{tarification}/edit', 'edit')->name('edit');
//     Route::put('{tarification}', 'update')->name('update');
//     Route::delete('{tarification}', 'destroy')->name('destroy');
// });

// Route::controller(TarificationController::class)
//     ->prefix('compagnie/tarification')
//     ->name('compagnie.tarification.')
//     ->group(function () {
//         Route::get('liste-tarification', 'index')->name('index');
//         Route::get('create', 'create')->name('create');
//         Route::post('store', 'store')->name('store');
//         Route::get('{tarification}', 'show')->name('show');
//         Route::get('{tarification}/edit', 'edit')->name('edit');
//         Route::put('{tarification}', 'update')->name('update');
//         Route::delete('{tarification}', 'destroy')->name('destroy');
//     });

    Route::controller(TarificationController::class)->group(function () {
        Route::get('/liste-tarification', 'index')->name('tarification.index');
        Route::get('/create', 'create')->name('tarification.create');
        Route::post('/store', 'store')->name('tarification.store');
        Route::get('/voir-tarification/{tarification}', 'show')->name('tarification.show');
        Route::get('/modifier-tarification/{tarification}', 'edit')->name('tarification.edit');
        Route::put('/modifier-tarification/{tarification}', 'update')->name('tarification.update');
        Route::delete('/supprimer-tarification/{tarification}', 'destroy')->name('tarification.destroy');
        
        // Routes pour l'activation/désactivation
        Route::get('tarification/{id}/toggle-status', 'toggleStatus')->name('toggle-status');
        Route::post('tarification/status/{id}', 'updateStatus')->name('update-status');
    });

Route::controller(VoyageController::class)->group(function () {
    Route::get('/voyage', 'index')->name('voyage.index');
    Route::get('/voyage/create', 'create')->name('voyage.create');
    Route::post('/voyage/store', 'store')->name('voyage.store');
    Route::get('/voyage/{id}', 'show')->name('voyage.show');
        Route::get('/voyage-edit/{id}', 'edit')->name('voyage.edit');
    Route::put('/voyage-update/{id}', 'update')->name('voyage.update');

    Route::post('/voyage/destroy/{id}', 'destroy')->name('voyage.destroy');
// Réactiver / Activer
    Route::post('/voyage/reactivation/{id}', 'destroy_reactivation')->name('voyage.reactivation');
    Route::get('/itineraire/{id}', 'details');

});

});



// Route::post('/seats/save', [ConfigurationBusController::class, 'store'])->name('seats.store');
Route::middleware(['auth'])->group(function () {
Route::controller(ConfigurationBusController::class)->group(function () {
        Route::post('/seats/save', 'store')->name('seats.store');
        Route::get('liste-config' , 'index')->name('listeconfig.index');
        Route::get('creation-config' , 'create')->name('creationConfig.creation');
        Route::get('/configurations/{id}','show_vrai')->name('config.show');

        Route::get('/configurations-edit/{id}', 'edit')->name('config.edit');
        Route::put('/configurations/{id}', 'update')->name('config.update');
        //activation et desactivation
        Route::post('/configurations/activation/{id}', 'activation')->name('config.activation');
        Route::post('/configurations/desactivation/{id}', 'desactivation')->name('config.desactivation');
});
});

// Routes pour les paramètres de la compagnie
Route::middleware(['auth'])->group(function () {
    Route::controller(\App\Http\Controllers\ParamettreController::class)->group(function () {
        Route::get('/parametre', 'index')->name('paramettre.index');
        Route::post('/parametre/update-logo', 'updateLogo')->name('parametre.update-logo');
        Route::put('/parametre/update-infos', 'updateInfos')->name('parametre.update-infos');
        Route::put('/parametre/update-password', 'updatePassword')->name('parametre.update-password');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(ReservationController::class)->group(function () {
        Route::get('/liste_reservation', 'liste_reservation')->name('liste_reservation');
        Route::get('detail_reservatiion-detail/{id}', 'voir_detail_reservation')->name('voir_detail_reservation.show');
    });
});


// Routes de paramètres utilisateur
Route::middleware(['auth'])->group(function () {
    Route::controller(\App\Http\Controllers\Admin\ParametreController::class)->group(function () {
        Route::get('/parametres', 'index')->name('admin.parametres.index');
        Route::put('/parametres/update-email', 'updateEmail')->name('admin.parametres.update-email');
        Route::put('/parametres/update-password', 'updatePassword')->name('admin.parametres.update-password');
    });

    // Routes de gestion des utilisateurs
    Route::controller(\App\Http\Controllers\Admin\UtilisateurController::class)->group(function () {
        Route::get('/utilisateurs', 'index')->name('admin.utilisateurs.index');
        Route::get('/utilisateurs/create', 'create')->name('admin.utilisateurs.create');
        Route::post('/utilisateurs', 'store')->name('admin.utilisateurs.store');
        Route::get('/utilisateurs-details/{utilisateur}', 'show')->name('admin.utilisateurs.show');
        Route::get('/utilisateurs-edit/{utilisateur}', 'edit')->name('admin.utilisateurs.edit');
        Route::put('/utilisateurs/{utilisateur}', 'update')->name('admin.utilisateurs.update');
        Route::delete('/utilisateurs/{utilisateur}', 'destroy')->name('admin.utilisateurs.destroy');
    });

        // Routes pour la gestion des agents
    Route::controller(AgentController::class)->group(function () {
        Route::get('/agents', 'index')->name('agents.index');
        Route::get('/agents_create', 'create')->name('agents.create');
        Route::post('/agents_store', 'store')->name('agents.store');
Route::get('/agents/{agent}', 'show')->name('agents.show');
        Route::get('/agents_edit/{agent}', 'edit')->name('agents.edit');
        Route::put('/agents_update/{agent}', 'update')->name('agents.update');
        Route::delete('/agents_destroy/{agent}', 'destroy')->name('agents.destroy');
Route::patch('/agents-toggle-status/{agent}', 'toggleStatus')->name('agents.toggle-status');

        
        // Route::resource('agents', AgentController::class)->except(['show']);
        // Route::get('agents/{agent}', [AgentController::class, 'show'])->name('agents.show');
    });

    // Routes pour la configuration web/mobile
    Route::get('/config_web_mobile_test', [ConfigWebMobileController::class, 'index'])->name('config_web_mobile.index');

    // Route::get('/config_web_mobile', [ConfigWebMobileController::class, 'index'])->name('config_web_mobile.index');
    Route::post('/config_web_mobile/store', [ConfigWebMobileController::class, 'store'])->name('config_web_mobile.store');
    Route::get('/config_web_mobile/{configWebMobile}/edit', [ConfigWebMobileController::class, 'edit'])->name('config_web_mobile.edit');
    Route::put('/config_web_mobile/{configWebMobile}', [ConfigWebMobileController::class, 'update'])->name('config_web_mobile.update');
    Route::delete('/config_web_mobile/{configWebMobile}', [ConfigWebMobileController::class, 'destroy'])->name('config_web_mobile.destroy');
    Route::post('/config_web_mobile/{configWebMobile}/toggle-status', [ConfigWebMobileController::class, 'toggleStatus'])->name('config_web_mobile.toggle-status');

    // Route de test pour diagnostiquer
Route::get('/test-config', function() {
    return 'Route de test fonctionne - ConfigWebMobileController existe: ' . class_exists('App\Http\Controllers\ConfigWebMobileController');
});

// API endpoint pour récupérer la configuration active
    Route::get('/api/config_web_mobile/active', [ConfigWebMobileController::class, 'getActiveConfig']);

});