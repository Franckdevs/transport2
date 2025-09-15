<?php

namespace App\Http\Controllers;

use App\Mail\FinalisationInscription;
use App\Models\Compagnies;
use App\Models\Otp;
use App\Models\reservation;
use App\Models\Utilisateur;
use App\Models\UtilisateurEnAttente;
use App\Models\Voyage;
use Illuminate\Http\Request;
use App\Mail\OtpMail; // Assure-toi d'avoir créé ce Mailable
use App\Models\Bus;
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

    public function inscription_finalisation_inscription(Request $request)
    {
        // ✅ Validation
        $request->validate([
            // 'email' => 'required',
            'token'=> 'nullable',
            'telephone' => 'nullable',
            'nom' => 'nullable',
            'prenom' => 'nullable',
            'password' => 'nullable',
        ]);

        $retrouverutilisateur = Utilisateur::where('token', $request->token)->first();

        if (!$retrouverutilisateur) {
            return response()->json([
                'Erreure'=>'cette utilisateur existe pas'
                ]);
        }
        // if (UtilisateurEnAttente::where('email', $request->email)->exists()) {
        //     return response()->json(['message' => 'Email déjà utilisé'], 422);
        // }

        // ✅ Création de l'utilisateur en attente
        // $retrouverutilisateur = new retrouverutilisateurEnAttente();
        // $retrouverutilisateur->email = $request->email;
        $retrouverutilisateur->telephone = $request->telephone;
        $retrouverutilisateur->nom = $request->nom;
        $retrouverutilisateur->prenom = $request->prenom;
        $retrouverutilisateur->password = $request->password;
        $retrouverutilisateur->save(); // 🔑 sauvegarde avant token

        // ✅ Génération du token API
        // $token = $utilisateur->createToken('API Token')->plainTextToken;
        // $utilisateur->token = $token;
        // $utilisateur->save();

        // ✅ Génération d’un code OTP unique (6 chiffres)
        // do {
        //     $otpCode = rand(100000, 999999);
        // } while (Otp::where('code', $otpCode)->exists());

        // // ✅ Enregistrement de l’OTP
        // Otp::create([
        //     'utilisateur_id' => $utilisateur->id,
        //     'code' => $otpCode,
        //     'status' => '1', // actif
        // ]);

        // ✅ Envoi de l’OTP par mail
        // Mail::to($utilisateur->email)->send(new FinalisationInscription($otpCode, $utilisateur));

        // ✅ Réponse JSON
        return response()->json([
            'message' => 'Inscription réussie, code OTP envoyé par email',
            'utilisateur' => $retrouverutilisateur,
        ], 200);
    }

    public function inscription_via_mail(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'email' => 'required',
        ]);

        if (UtilisateurEnAttente::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'Email déjà utilisé'], 422);
        }
        // ✅ Création de l'utilisateur en attente
        $utilisateur = new UtilisateurEnAttente();
        $utilisateur->email = $request->email;
        // $utilisateur->telephone = $request->telephone;
        // $utilisateur->nom = $request->nom;
        // $utilisateur->prenom = $request->prenom;
        // $utilisateur->password = $request->password;
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
        ], 200);
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
    $verifier_utilisateur = Utilisateur::where('token', $request->token)->first();
    
    if ($verifier_utilisateur) {
        return response()->json([
            'message' => 'Cet utilisateur est déjà validé.',
        ], 200);
    }

    return response()->json([
        'message' => 'Token invalide',
    ], 404);
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
    $otp->delete();

    //  return response()->json([
    //     'message'=> 'ds',
    //     'tzst'=> $utilisateur,
    //     'd'=> $otp
    //     ],200);

    // 🔑 Générer un token API via Sanctum
    // $apiToken = $utilisateur->createToken('API Token')->plainTextToken;
    // $utilisateur->token = $apiToken;
    // $utilisateur->save();

    //creation de l'utilisateur
    $user = new Utilisateur();
    // $user->nom = $utilisateur->nom;
    // $user->prenom = $utilisateur->prenom;
    $user->email = $utilisateur->email;
    // $user->telephone = $utilisateur->telephone;
    // $user->password = $utilisateur->password;
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

// public function listeCompagnie(Request $request)
// {
//     $listeCompagnie = Compagnies::all();

//     if ($listeCompagnie->isEmpty()) {
//         return response()->json([
//             'message' => 'Aucune compagnie trouvée',
//             'listecompagnie' => []
//         ], 200);
//     }

//     return response()->json([
//         'message' => 'Liste des Compagnies',
//         'listecompagnie' => $listeCompagnie
//     ], 200);
// }
public function listeCompagnie(Request $request)
{
    $listeCompagnie = Compagnies::all();

    if ($listeCompagnie->isEmpty()) {
        return response()->json([
            'message' => 'Aucune compagnie trouvée',
            'listecompagnie' => []
        ], 200);
    }

    $listeCompagnie = $listeCompagnie->map(function ($compagnie) {
        if ($compagnie->logo_compagnies) {
            $compagnie->logo_url  = url($compagnie->logo_compagnies);  // URL complète pour frontend
            $compagnie->logo_path = 'logo_compagnie/' . $compagnie->logo_compagnies; // chemin relatif avec dossier
        } else {
            $compagnie->logo_url  = url('assets/img/default-user.png'); 
            $compagnie->logo_path = null;
        }
        return $compagnie;
    });

    return response()->json([
        'message' => 'Liste des Compagnies',
        'listecompagnie' => $listeCompagnie
    ], 200);
}


public function listevoayge(Request $request , $id)
{
    // $compagnie = Compagnies::with([
    //     'gares.itineraires.voyages' // on ajoute voyages ici
    // ])->find($id);

    $compagnie = Compagnies::with([
    'gares.itineraires.voyages.chauffeur',
    'gares.itineraires.voyages.bus',
])->find($id);


    if (!$compagnie) {
        return response()->json([
            'message' => 'Compagnie non trouvée',
        ], 404);
    }

    return response()->json([
        'message' => 'Compagnie trouvée',
        'compagnie' => $compagnie,
        // 'gares' => $compagnie->gares->map(function($gare) {
        //     return [
        //         'gare' => $gare,
        //         'itineraires' => $gare->itineraires->map(function($itineraire) {
        //             return [
        //                 'itineraire' => $itineraire,
        //                 'voyages' => $itineraire->voyages
        //             ];
        //         }),
        //     ];
        // }),
        // 'itineraires_compagnie' => $compagnie->itineraires->map(function($itineraire) {
        //     return [
        //         'itineraire' => $itineraire,
        //         'voyages' => $itineraire->voyages
        //     ];
        // }),
    ], 200);
}

// public function reservation(Request $request)
// {
//     $request->validate([
//         'voyage_id' => 'required|exists:voyages,id',
//         'token' => 'required',
//         'numero_place' => 'required',
//     ]);

//     $id = $request->input('voyage_id');
//     $voyage = Voyage::find($id);
//     if (!$voyage) {
//         return response()->json([
//             'message' => 'Voyage non trouvée',
//         ], 404);
//     }

//     $utilisateur = Utilisateur::where('token', $request->token)->first();
//     if (!$utilisateur) {
//         return response()->json([
//             'message' => 'Utilisateur non trouvée',
//         ], 404);
//     }

//     // $compagnie = Compagnies::with([
//     //     'gares.itineraires.voyages.chauffeur',
//     //     'gares.itineraires.voyages.bus',
//     // ])->find($voyage->compagnie_id);
//     $bus = Bus::where('id', $voyage->bus_id)->first();

//     $reservation = new reservation();
//     $reservation->voyages_id = $voyage->id;
//     $reservation->utilisateurs_id = $utilisateur->id;
//     $reservation->numero_place = $request->input('numero_place');
//     $reservation->save();



//     return response()->json([
//         'message' => 'Reservation effectuer',
//         'voyage' => $voyage,
//         'bus'=> $bus,
//         'utilisateur' => $utilisateur,
//         // 'compagnie'=>$compagnie
//     ]);

//     // return response()->json([
//     //     'message' => 'Reservation effectuer',
//     //     'reservation' => $reservation,
//     // ], 200);

// }


public function reservation(Request $request)
{
    $request->validate([
        'voyage_id' => 'required|exists:voyages,id',
        'token' => 'required',
        'numero_place' => 'required|integer|min:1',
    ]);

    $id = $request->input('voyage_id');
    $voyage = Voyage::find($id);
    if (!$voyage) {
        return response()->json([
            'message' => 'Voyage non trouvé',
        ], 404);
    }

    $utilisateur = Utilisateur::where('token', $request->token)->first();
    if (!$utilisateur) {
        return response()->json([
            'message' => 'Utilisateur non trouvé',
        ], 404);
    }

$bus = Bus::with('configurationPlace')->find($voyage->bus_id);
    // Vérifier si la place demandée existe dans le bus
    if ($request->numero_place > $bus->nombre_places) {
        return response()->json([
            'message' => "Le bus ne contient que {$bus->nombre_places} places",
        ], 400);
    }

    // Vérifier si la place est déjà réservée pour ce voyage
    $placeDejaPrise = Reservation::where('voyages_id', $voyage->id)
        ->where('numero_place', $request->numero_place)
        ->exists();

    if ($placeDejaPrise) {
        return response()->json([
            'message' => "La place numéro {$request->numero_place} est déjà réservée.",
        ], 409);
    }

    // Enregistrer la réservation
    $reservation = new Reservation();
    $reservation->voyages_id = $voyage->id;
    $reservation->utilisateurs_id = $utilisateur->id;
    $reservation->numero_place = $request->numero_place;
    $reservation->save();

    return response()->json([
        'message' => 'Réservation effectuée avec succès',
        'voyage' => $voyage,
        'bus' => $bus,
        'utilisateur' => $utilisateur,
        'reservation' => $reservation,
    ], 201);
}


public function placesRestantes(Request $request)
{
    $request->validate([
        'voyage_id' => 'required',
    ]);
    
    // Récupérer le voyage
    $voyage = Voyage::find($request->voyage_id);
    if (!$voyage) {
        return response()->json([
            'message' => 'Voyage non trouvé',
        ], 404);
    }

    // Récupérer le bus associé
    $bus = Bus::find($voyage->bus_id);
    if (!$bus) {
        return response()->json([
            'message' => 'Bus non trouvé',
        ], 404);
    }

    // Nombre total de places dans le bus
    $totalPlaces = (int) $bus->nombre_places;

    // Liste des places déjà réservées pour ce voyage
    $placesReservees = Reservation::where('voyages_id', $voyage->id)
        ->pluck('numero_place')
        ->toArray();

    // Calcul des places restantes
    $placesRestantes = array_diff(range(1, $totalPlaces), $placesReservees);

    return response()->json([
        'voyage_id' => $voyage->id,
        'bus_id' => $bus->id,
        'total_places' => $totalPlaces,
        'places_reservees' => $placesReservees,       // liste des places déjà prises
        'places_restantes' => array_values($placesRestantes), // liste des places libres
    ]);
}




}



