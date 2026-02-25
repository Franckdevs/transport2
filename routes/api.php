<?php

use App\Http\Controllers\Admin\UtilisateurController as AdminUtilisateurController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ConfigWebMobileController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PaiementEnAttenteController;
use App\Http\Controllers\UtilisateurController;
use App\Mail\AgentAccountMail;
use App\Models\Agent;
use App\Models\Paiement;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Routes pour la gestion des OTP
Route::get('trouver_agent_via_token/{token}', [AgentController::class, 'trouver_agent_via_token']);

Route::post('modifierMotDePasseAgent' , [AgentController::class,'modifierMotDePasseAgent']);

Route::get('liste_des_client/{token}',[AgentController::class,'liste_des_client']);

Route::post('statistique', [AgentController::class, 'statistique']);

Route::get('liste_deja_reservation_effectuer/{token}', [AgentController::class, 'liste_deja_reservation_effectuer']);

Route::post('/validate-token', [AgentController::class, 'verifier_token_user_existe']);

Route::get('connexion_rapide_qrcode/{token}', [AgentController::class, 'connexion_rapide_qrcode']);

Route::post('scanner_ticket_avec_code',[AgentController::class,'scanner_ticket_avec_code']);

Route::post('login',[AgentController::class ,'login']);

Route::post('scanner_ticket' , [AgentController::class , 'scanner_ticket']);

Route::get('liste_detail_paiement/{token}' , [UtilisateurController::class , 'liste_detail_paiement']);

Route::post('connexion' , [UtilisateurController::class , 'connexion']);

Route::get('/verifier_utilisateur_existe/{token}', [UtilisateurController::class, 'verifier_utilisateur_existe']);

Route::get('/liste_reservation/{token}', [UtilisateurController::class, 'liste_reservation']);

Route::post('/modifier_information_utilisateur', [UtilisateurController::class, 'modifier_information_utilisateur']);

Route::get('/recuperer_utilisateur/{token}', [UtilisateurController::class, 'recuperer_utilisateur']);

Route::get('/bus_detail_place/{id}/{id_voyage}', [UtilisateurController::class, 'bus_detail_place']);

Route::get('/liste_gare_compagnie/{id}', [UtilisateurController::class, 'liste_gare_compagnie']);

Route::get('/liste_ville', [UtilisateurController::class, 'liste_ville']);

Route::post('/choisir_destination', [UtilisateurController::class, 'choisir_destination']);

Route::post('/generate-otp', [UtilisateurController::class, 'generateOtp']);

Route::post("inscription_via_mail", [UtilisateurController::class,"inscription_via_mail"]);

Route::post('/inscription_finalisation', [UtilisateurController::class, 'inscription_finalisation_inscription']);

Route::post('/verifier-otp', [UtilisateurController::class, 'verifierOtp']);

Route::get('/listeCompagnie', [UtilisateurController::class, 'listeCompagnie']);

// Route pour les statistiques des réservations
Route::middleware('auth:sanctum')->get('/stats-reservations', function (Request $request) {
    $debut = $request->query('debut');
    $fin = $request->query('fin');
    
    // Récupérer l'utilisateur authentifié
    $user = $request->user();
    
    // Récupérer la compagnie de l'utilisateur
    $compagnie = $user->info_user->compagnie;
    
    if (!$compagnie) {
        return response()->json([
            'error' => 'Aucune compagnie associée à cet utilisateur'
        ], 403);
    }
    
    // Récupérer les réservations filtrées par date et compagnie
    $reservations = \App\Models\Reservation::whereDate('created_at', '>=', $debut)
        ->whereDate('created_at', '<=', $fin)
        ->where('compagnie_id', $compagnie->id)
        ->get();
    
    // Calculer les statistiques
    return response()->json([
        'total' => $reservations->count(),
        'confirmees' => $reservations->where('statut', 'confirmé')->count(),
        'annulees' => $reservations->where('statut', 'annulé')->count(),
        'en_attente' => $reservations->where('statut', 'en_attente')->count(),
    ]);
});

Route::get('/listevoayge/{id}', [UtilisateurController::class, 'listevoayge']);

Route::get('/listeGare/{id}', [UtilisateurController::class, 'listeGare']);

Route::get('/listeVoyage/{id}', [UtilisateurController::class, 'listeVoyage_avec_itineraire']);

Route::post('/reservation', [UtilisateurController::class, 'reservation']);

Route::post('/places-restantes', [UtilisateurController::class, 'placesRestantes']);

// Récupérer les détails d'un chauffeur
Route::get('/chauffeur/{id}/details', [\App\Http\Controllers\VoyageController::class, 'getChauffeurDetails'])
    ->name('api.chauffeur.details')
    ->where('id', '[0-9]+');

// Récupérer les détails d'un bus avec sa configuration
Route::get('/bus/{id}/details', [\App\Http\Controllers\VoyageController::class, 'getBusDetails'])
    ->name('api.bus.details')
    ->where('id', '[0-9]+');

Route::get('recu_reservation/{token}', [UtilisateurController::class,'recu_reservation']);

Route::post('InitiationPaiement', [PaiementEnAttenteController::class,'InitiationPaiement']);

Route::post('callback', [PaiementController::class,'callback']);

Route::get('/listeVoyage_avec_itineraire_avec_ville/{id}', [UtilisateurController::class, 'listeVoyage_avec_itineraire_avec_ville']);


Route::post('/assign-permission', [UtilisateurController::class, 'assignPermission']);
Route::get('/user-permissions/{id}', [UtilisateurController::class, 'getUserPermissions']);

// API endpoints pour la configuration web/mobile
Route::get('/config_web_mobile/image_acceuil_mobile', [ConfigWebMobileController::class, 'getImageAccueilMobile']);
Route::get('/config_web_mobile/sous_image_acceuil_mobile', [ConfigWebMobileController::class, 'getSousImageAccueilMobile']);
Route::get('/config_web_mobile/image_acceuil_web', [ConfigWebMobileController::class, 'getImageAccueilWeb']);
Route::get('/config_web_mobile/sous_image_acceuil_web', [ConfigWebMobileController::class, 'getSousImageAccueilWeb']);
Route::get('/config_web_mobile/image_connexion_web', [ConfigWebMobileController::class, 'getImageConnexionWeb']);
Route::get('/config_web_mobile/all', [ConfigWebMobileController::class, 'getAllConfig']);



