<?php

use App\Http\Controllers\UtilisateurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/inscription', [UtilisateurController::class, 'inscription']);

Route::post('/verifier-otp', [UtilisateurController::class, 'verifierOtp'])->middleware('auth:sanctum');

Route::get('/listeCompagnie', [UtilisateurController::class, 'listeCompagnie'])->middleware('auth:sanctum');

Route::get('/listevoayge/{id}', [UtilisateurController::class, 'listevoayge'])->middleware('auth:sanctum');

Route::post('/reservation', [UtilisateurController::class, 'reservation'])->middleware('auth:sanctum');
