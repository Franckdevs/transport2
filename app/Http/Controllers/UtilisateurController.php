<?php

namespace App\Http\Controllers;

use App\Models\Compagnies;
use App\Models\Otp;
use App\Models\reservation;
use App\Models\Utilisateur;
use App\Models\UtilisateurEnAttente;
use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Mail\OtpMail; // Assure-toi d'avoir créé ce Mailable
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UtilisateurController extends Controller
{
    //
    public function inscriptions(Request $request)
    {
        $request->validate([
        'email' => 'required|email|unique:utilisateurs,email',
        ]);

        $email = $request->input('email');
        $utilisateur = new Utilisateur();
        $utilisateur->email = $email;
        $utilisateur->save();

    }

    public function inscription(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'email' => 'required',
            'telephone' => 'nullable',
            'nom' => 'nullable',
            'prenom' => 'nullable',
            'password' => 'nullable',
        ]);

        if (UtilisateurEnAttente::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email déjà utilisé'], 422);
        }
        // ✅ Création de l'utilisateur en attente
        $utilisateur = new UtilisateurEnAttente();
        $utilisateur->email = $request->email;
        $utilisateur->telephone = $request->telephone;
        $utilisateur->nom = $request->nom;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->password = $request->password;
        $utilisateur->save(); // 🔑 sauvegarde avant token

        // ✅ Génération du token API
        $token = $utilisateur->createToken('API Token')->plainTextToken;
        $utilisateur->token = $token;
        $utilisateur->save();

        // ✅ Génération d’un code OTP unique (6 chiffres)
        do {
            $otpCode = rand(100000, 999999);
        } while (Otp::where('code', $otpCode)->exists());

        // ✅ Enregistrement de l’OTP
        Otp::create([
            'utilisateur_id' => $utilisateur->id,
            'code' => $otpCode,
            'status' => '1', // actif
        ]);

        // return response()->json([
        // 'message' => 'ok',
        // 'email' => $request->email,
        // 'utilisateur' => $utilisateur,
        // 'otp' => $otpCode,
        // 'token' => $token, // à utiliser côté client pour authentification API
        // ], 200);

        // ✅ Envoi de l’OTP par mail
        Mail::to($utilisateur->email)->send(new OtpMail($otpCode, $utilisateur));

        // ✅ Réponse JSON
        return response()->json([
            'message' => 'Inscription réussie, code OTP envoyé par email',
            'utilisateur' => $utilisateur,
            'otp' => $otpCode,
            // 'token' => $token,
            // 'token' => $token, // à utiliser côté client pour authentification API
        ], 201);
    }




    public function verifierOtp(Request $request)
{
    // ✅ Validation de la requête
    $request->validate([
        'token' => 'required|string',
        'code'  => 'required',
    ]);

    // ✅ Récupération de l'utilisateur via token
    $utilisateur = UtilisateurEnAttente::where('token', $request->token)->first();
    if (!$utilisateur) {
        return response()->json(['message' => 'Token invalide'], 404);
    }
//    return response()->json(['message' => 'Utilisateur trouvé', 'utilisateur' => $utilisateur], 200);
    // ✅ Vérification de l'OTP
    $otp = Otp::where('utilisateur_id', $utilisateur->id)
    ->where('code', $request->code)
    ->first();
// return response()->json(['message' => 'ok' , 'otp' => $otp], 200);
    if (!$otp) {
        return response()->json(['message' => 'Code OTP invalide ou expiré'], 422);
    }

    // ✅ Vérifier expiration (par ex. 10 minutes)
    $expiration = Carbon::parse($otp->created_at)->addMinutes(10);
    if (Carbon::now()->gt($expiration)) {
        $otp->save();
        return response()->json(['message' => 'Code OTP expiré'], 422);
    }

    // return response()->json(['message' => 'ok'], 200);
    // ✅ OTP correct : marquer comme utilisé
    $otp->status = '3'; // utilisé
    $otp->save();

    // 🔑 Générer un token API via Sanctum
    $apiToken = $utilisateur->createToken('API Token')->plainTextToken;
    $utilisateur->token = $apiToken;
    $utilisateur->save();

    //creation de l'utilisateur
    $user = new Utilisateur();
    $user->nom = $utilisateur->nom;
    $user->prenom = $utilisateur->prenom;
    $user->email = $utilisateur->email;
    $user->telephone = $utilisateur->telephone;
    $user->password = $utilisateur->password;
    $user->token = $utilisateur->token;
    $user->save();

    // Suppression de l'utilisateur en attente
    $utilisateur->delete();

    return response()->json([
        'message' => 'OTP vérifié avec succès',
        'utilisateur' => $utilisateur ?? null,
        'token' => $apiToken ?? null,
        'status'=> true
    ], 200);
}

public function listeCompagnie(Request $request)
{
    $listeCompagnie = Compagnies::all();

    if ($listeCompagnie->isEmpty()) {
        return response()->json([
            'message' => 'Aucune compagnie trouvée',
            'listecompagnie' => []
        ], 200);
    }

    return response()->json([
        'message' => 'Liste des Compagnies',
        'listecompagnie' => $listeCompagnie
    ], 200);
}

public function listevoayge(Request $request , $id)
{
    $compagnie = Compagnies::with([
        'gares.itineraires.voyages' // on ajoute voyages ici
    ])->find($id);

    if (!$compagnie) {
        return response()->json([
            'message' => 'Compagnie non trouvée',
        ], 404);
    }

    return response()->json([
        'message' => 'Compagnie trouvée',
        'compagnie' => $compagnie,
        'gares' => $compagnie->gares->map(function($gare) {
            return [
                'gare' => $gare,
                'itineraires' => $gare->itineraires->map(function($itineraire) {
                    return [
                        'itineraire' => $itineraire,
                        'voyages' => $itineraire->voyages
                    ];
                }),
            ];
        }),
        'itineraires_compagnie' => $compagnie->itineraires->map(function($itineraire) {
            return [
                'itineraire' => $itineraire,
                'voyages' => $itineraire->voyages
            ];
        }),
    ], 200);
}

public function reservation(Request $request)
{
    $request->validate([
        'voyage_id' => 'required|exists:voyages,id',
        'token' => 'required',
        'numero_place' => 'required',
    ]);


    $id = $request->input('voyage_id');
    $voyage = Voyage::find($id);
    if (!$voyage) {
        return response()->json([
            'message' => 'Voyage non trouvée',
        ], 404);
    }

    $utilisateur = Utilisateur::where('token', $request->token)->first();
    if (!$utilisateur) {
        return response()->json([
            'message' => 'Utilisateur non trouvée',
        ], 404);
    }

    $reservation = new reservation();
    $reservation->voyages_id = $voyage->id;
    $reservation->utilisateurs_id = $utilisateur->id;
    $reservation->numero_place = $request->input('numero_place');
    $reservation->save();
    return response()->json([
        'message' => 'Reservation effectuer',
        'voyage' => $voyage,
        'utilisateur' => $utilisateur
    ]);

    // return response()->json([
    //     'message' => 'Reservation effectuer',
    //     'reservation' => $reservation,
    // ], 200);

}




}



