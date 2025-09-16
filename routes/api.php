<?php

use App\Http\Controllers\UtilisateurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post("inscription_via_mail", [UtilisateurController::class,"inscription_via_mail"]);

Route::post('/inscription_finalisation', [UtilisateurController::class, 'inscription_finalisation_inscription']);

Route::post('/verifier-otp', [UtilisateurController::class, 'verifierOtp']);

Route::get('/listeCompagnie', [UtilisateurController::class, 'listeCompagnie']);

Route::get('/listevoayge/{id}', [UtilisateurController::class, 'listevoayge']);

Route::post('/reservation', [UtilisateurController::class, 'reservation']);

Route::post('/places-restantes', [UtilisateurController::class, 'placesRestantes']);

Route::get('recu_reservation/{token}', [UtilisateurController::class,'recu_reservation']);
