<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\UtilisateurEnAttente;
use App\Models\Gare;
use App\Models\ArretVoyage;
use App\Models\Bus;
use App\Models\Itineraire;
use App\Models\Otp;
use App\Mail\OtpMail;
use App\Models\Arret;
use App\Models\Compagnies;
use App\Models\Paiement;
use App\Models\PaiementEnAttente;
use App\Models\Reservation;
use App\Models\RoleUtilisateur;
use App\Models\TarificationMontantVoyage;
use App\Models\User;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{

//     public function liste_detail_paiement($token){
//     $utilisateur = Utilisateur::where('token', $token)->first();
//     $paiement = Paiement::where('utilisateur_id' ,$utilisateur->id)->first();
//     $Compagnies = Compagnies::where('id',$paiement->compagnie_id)->first();
//     $gares = Gare::where('id' ,$Compagnies->gares_id)->first();
//     $arret = Arret::where('id',$paiement->id_arret_voayage)->first();
//     $tarrification = TarificationMontantVoyage::with(['villeDepart','villeArrivee'])->where('id',$arret->id_tarrification_voyage)->first();
     
//    return response()->json([
    
//    ]);
//     }

// public function liste_detail_paiement($token)
// {
//     $utilisateur = Utilisateur::where('token', $token)->first();

//     if (!$utilisateur) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Utilisateur introuvable'
//         ], 404);
//     }

//     $paiement = Paiement::where('utilisateur_id', $utilisateur->id)->first();

//     if (!$paiement) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Aucun paiement trouvé'
//         ], 404);
//     }

//     $compagnie = Compagnies::find($paiement->compagnie_id);
//     $gare = Gare::where('id',$paiement->gares_id)->first();
//     $arret = Arret::find($paiement->id_arret_voayage);
//     $tarification = $arret
//         ? TarificationMontantVoyage::with(['villeDepart', 'villeArrivee'])
//             ->find($arret->id_tarrification_voyage)
//         : null;

//     return response()->json([
//         'success' => true,
//         'utilisateur' => $utilisateur,
//         'paiement' => $paiement,
//         'compagnie' => $compagnie,
//         'gare' => $gare,
//         'arret' => $arret,
//         'tarification' => $tarification,
//     ], 200);
// }

public function liste_detail_paiement($token)
{
    $utilisateur = Utilisateur::where('token', $token)->first();

    if (!$utilisateur) {
        return response()->json([
            'success' => false,
            'message' => 'Utilisateur introuvable'
        ], 404);
    }

    $paiements = Paiement::where('utilisateur_id', $utilisateur->id)->where('status', 1)->get();
    // $paiements = Paiement::where('utilisateur_id', $utilisateur->id)->get();

    if ($paiements->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aucun paiement trouvé'
        ], 404);
    }

    $detailsPaiements = [];

    foreach ($paiements as $paiement) {

        $compagnie = Compagnies::find($paiement->compagnie_id);
        $gare = Gare::where('id', $paiement->gares_id)->first();
        $arret = Arret::find($paiement->id_arret_voayage);

        $tarification = $arret
            ? TarificationMontantVoyage::with(['villeDepart', 'villeArrivee'])
                ->find($arret->id_tarrification_voyage)
            : null;

        $detailsPaiements[] = [
            'paiement' => $paiement,
            'compagnie' => $compagnie,
            'gare' => $gare,
            'arret' => $arret,
            'tarification' => $tarification,
        ];
    }

    return response()->json([
        'success' => true,
        'utilisateur' => $utilisateur,
        'paiements' => $detailsPaiements,
    ], 200);
}



public function connexion(Request $request)
{
    // Validation des données
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);
    // Vérifier si l'utilisateur existe
    $utilisateur = Utilisateur::where('email', $request->email)->first();

    if (!$utilisateur) {
        return response()->json([
            'success' => false,
            'message' => 'information incorrecte'
        ], 404);
    }
    // Vérifier le mot de passe
    if (!Hash::check($request->password, $utilisateur->password)) {
        return response()->json([
            'success' => false,
            'message' => 'information incorrecte'
        ], 401);
    }
    // Générer un token API avec Sanctum
    $token = $utilisateur->createToken('API Token')->plainTextToken;
    $utilisateur->token = $token;
    $utilisateur->save();
    return response()->json([
        'success' => true,
        'message' => 'Connexion réussie.',
        'user' => $utilisateur,
        'token' => $token
    ]);
}


    public function verifier_utilisateur_existe ($token){

        $utilisateur = Utilisateur::where('token', $token)->first();

        if(!$utilisateur){
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur trouvé',
                'data' => $utilisateur,
            ], 200);
        }
    }

    public function assignPermission(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string'
        ]);

        $user = User::find($request->user_id);

        // Vérifier si la permission existe
        $permission = Permission::where('name', $request->permission)->first();

        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => "La permission '{$request->permission}' n'existe pas."
            ], 404);
        }

        // Ajouter la permission
        $user->givePermissionTo($permission);

        return response()->json([
            'success' => true,
            'message' => "Permission attribuée avec succès.",
            'user' => $user->name,
            'permission' => $request->permission
        ]);
    }


    public function getUserPermissions($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => "Utilisateur introuvable."
        ], 404);
    }

    // Récupérer toutes les permissions de l’utilisateur
    $permissions = $user->getAllPermissions()->pluck('name');

    return response()->json([
        'success' => true,
        'user' => $user->name,
        'permissions' => $permissions
    ]);
}


   
    public function liste_reservation(Request $request , $token){

        $utilisateur = Utilisateur::where('token', $token)->first();
        if (!$utilisateur) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }
        $reservation = Reservation::with(['arret','gares','arret.tarification','arret.tarification.villeDepart','arret.tarification.villeArrivee','voyage','voyage.bus' , 'voyage.bus.places'])
        ->where('utilisateurs_id', $utilisateur->id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Liste des reservations',
            'data' => $reservation,
        ], 200);
    }

    public function modifier_information_utilisateur(Request $request){
    $request->validate([
        'token' => 'required',
        'nom' => 'nullable',
        'prenom' => 'nullable',
        'telephone' => 'nullable',
        'password' => 'nullable', // facultatif et sécurisé
    ]);

    $utilisateur = Utilisateur::where('token', $request->token)->first();

    if (!$utilisateur) {
        return response()->json([
            'success' => false,
            'message' => 'Utilisateur non trouvé',
        ], 404);
    }

    if ($request->has('nom')) {
        $utilisateur->nom = $request->nom;
    }

    if ($request->has('prenom')) {
        $utilisateur->prenom = $request->prenom;
    }

    if ($request->has('telephone')) {
        $utilisateur->telephone = $request->telephone;
    }

    // 🔐 Mise à jour du mot de passe seulement s'il est envoyé
    if ($request->filled('password')) {
        // $utilisateur->password = bcrypt($request->password);
        $utilisateur->password = Hash::make($request->password);
    }


    $utilisateur->save();

    return response()->json([
        'success' => true,
        'message' => 'Information modifiée',
        'data' => $utilisateur,
    ], 200);
}



    public function recuperer_utilisateur($token){
        $utilisateur = Utilisateur::where('token', $token)->first();
        return response()->json([
            'success' => true,
            'message' => 'Utilisateur trouvé',
            'data' => $utilisateur,
        ], 200);
    }

    public function bus_detail_place($busID , $id_voyage){
        $bus = Bus::with('configurationPlace','places')->find($busID);
        $voyage = Voyage::where('id',$id_voyage)->where('bus_id', $bus->id)->first();
        $liste_place_deja_occupe = Reservation::where('voyages_id', $voyage->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Bus trouvé',
            'nombre_places' => $bus->places->count(),
            'voyage' => $voyage,
            'liste_place_deja_occupe' => $liste_place_deja_occupe,
            'data' => $bus,
        ], 200);
    }

    public function liste_gare_compagnie($compagnieID){
    $liste = gare::with('ville' , 'jourOuvert' , 'jourFermeture')->where('compagnie_id', $compagnieID)->get();
    return response()->json([
        'success' => true,
        'message' => 'Liste des gares',
        'data' => $liste,
    ], 200);
    }



    public function liste_ville ()
    {
        $ville = Ville::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des villes',
            'data' => $ville,
        ], 200);
    }

    public function choisir_destination(Request $request)
    {
        $request->validate([
            'compagnie_id' => 'required',
            'ville_depart' => 'required',
            'ville_arrivee' => 'required',
            'date_depart' => 'required',
            // 'gare_depart' => 'required',
        ]);
        // return $request->all();
        $compagnie = Compagnies::where('id', $request->compagnie_id)->first();
        if (!$compagnie) {
            return response()->json([
                'success' => false,
                'message' => 'Compagnie non trouvée',
            ], 404);
        }

       $recuperer_voyage = Voyage::with([
        'bus',
        'bus.places',
        'itineraire',
        'itineraire.arrets',
        'itineraire.arrets.tarification',
        'itineraire.arrets.tarification.villeDepart',
        'itineraire.arrets.tarification.villeArrivee',
        'itineraire.arrets.tarification.classe'
    ])
    ->where('compagnie_id', $compagnie->id)
    // ->where('gare_id', $request->gare_depart)
    // ->whereDate('date_depart', $request->date_depart)
    ->where(function ($q) use ($request) {
    $q->where('disponible_toujours', 1)
      ->orWhereDate('date_depart', $request->date_depart);
})
    ->whereHas('itineraire.arrets.tarification', function ($q) use ($request) {
        $q->where('ville_depart_id', $request->ville_depart)
          ->where('ville_arrivee_id', $request->ville_arrivee);
    })
    ->get()->map(function ($voyage) {
        return [
            'id' => $voyage->id,
            'date_depart' => $voyage->date_depart,
            'heure_depart' => $voyage->heure_depart,
            'disponible_toujours'=>$voyage->disponible_toujours,
            'bus' => [
                'id' => $voyage->bus->id,
                'nom_bus' => $voyage->bus->nom_bus,
                'marque_bus' => $voyage->bus->marque_bus,
                'immatriculation_bus' => $voyage->bus->immatriculation_bus,
                'photo_bus' => $voyage->bus->photo_bus,
                'nombre_places' => $voyage->bus->places->count(), // 👈 TOTAL PLACES
            ],
            'itineraire' => $voyage->itineraire,
            'arrets' => $voyage->itineraire->arrets
        ];
    });

    return response()->json([
        'success' => true,
        'message' => 'Voyages trouvés',
        'data' => $recuperer_voyage,
    ], 200);
    }

    
    /**
     * Génère et envoie un code OTP par email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateOtp(Request $request)
    {
        // Validation de l'email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Génération d'un code OTP à 6 chiffres
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = $request->email;

        try {
            // Récupération de l'utilisateur
            $utilisateur = UtilisateurEnAttente::where('email', $email)->first();
            
            if (!$utilisateur) {
                return response()->json([
                    'success' => true,
                    'message' => 'Code OTP envoyé avec succès',
                    'data' => [
                        'email' => $email,
                    ]
                ], 200);
            }

            // Vérifier s'il existe déjà un OTP non expiré
            $existingOtp = Otp::where('utilisateur_id', $utilisateur->id)
                ->first();

            if ($existingOtp) {

                Mail::to($email)->send(new OtpMail($existingOtp->code, $utilisateur));
                return response()->json([
                    'success' => false,
                    'message' => 'Le code à été envoyé',
                ], 200);
            }

            // Création du nouvel OTP
            $otp = new Otp();
            $otp->utilisateur_id = $utilisateur->id;
            $otp->code = $otpCode;
            $otp->status = '1'; // 1 = actif, 2 = utilisé, 3 = expiré
            $otp->save();

            // Envoi de l'email avec le code OTP
            Mail::to($email)->send(new OtpMail($otpCode, $utilisateur));

            return response()->json([
                'success' => true,
                'message' => 'Code OTP envoyé avec succès',
                'data' => [
                    'email' => $email,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi du code OTP',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // Votre code existant ci-dessous
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

    public function  inscription_finalisation_inscription(Request $request)
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
        // $retrouverutilisateur->password = $request->password;
        $retrouverutilisateur->password = Hash::make($request->password);
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
            'message' => 'Inscription réussie avec succès',
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

        //    if (RoleUtilisateur::where('email', $request->email)->exists()) {
        //     return response()->json(['message' => 'Email déjà utilisé'], 422);
        // }
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
            'status'=> true,
            'message' => 'Inscription réussie, code OTP envoyé par email',
            'utilisateur' => $utilisateur,
            'otp' => $otpCode,
            'token' => $token,
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

    // return response()->json([
    //     'message' => 'ok',
    //     'token' => $request->token,
    //     'code' => $request->code,
    // ], 200);    
  
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
    // $expiration = Carbon::parse($otp->created_at)->addMinutes(10);
    // if (Carbon::now()->gt($expiration)) {
    //     $otp->save();
    //     return response()->json(['message' => 'Code OTP expiré'], 422);
    // }

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
        'status' => true,
        'message' => 'OTP vérifié avec succès',
        'utilisateur' => $utilisateur ?? null,
        'token' => $apiToken ?? null,
        // 'status'=> true
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
        // $listeCompagnie = Compagnies::all();
        $listeCompagnie = Compagnies::where('status', 1)->get();

        if ($listeCompagnie->isEmpty()) {
            return response()->json([
                'message' => 'Aucune compagnie trouvée',
                'listecompagnie' => []
            ], 200);
        }

        $listeCompagnie = $listeCompagnie->map(function ($compagnie) {
            if ($compagnie->logo_compagnies) {
                // Tes fichiers sont dans /public/logo_compagnie/
                $compagnie->logo_url  = asset( $compagnie->logo_compagnies);
                $compagnie->logo_path =  $compagnie->logo_compagnies;
            } else {
                $compagnie->logo_url  = asset('assets/img/default-user.png');
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
    $compagnie = Compagnies::with([
    'ville',
    'gares.ville',    
    'gares.jourOuvert',
    'gares.jourFermeture',
    'gares.itineraires.voyages.chauffeur',
    'gares.itineraires.voyages.bus',
    'gares.itineraires.arrets', // <- on ajoute les arrêts ici
    'gares.itineraires.voyages.arretVoyages.arret', // arrêts avec montant pour chaque voyage
    ])->find($id);

    if (!$compagnie) {
        return response()->json([
            'message' => 'Compagnie non trouvée',
        ], 404);
    }

    return response()->json([
        'message' => 'Compagnie trouvée',
        'compagnie' => $compagnie,
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

private function generateRandomString($length = 10) {
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$randomString = '';

for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, strlen($characters) - 1)];
}

return $randomString;
}


// private function generateRandomString($length = 10)
// {
//     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

//     do {
//         $randomString = '';
//         for ($i = 0; $i < $length; $i++) {
//             $randomString .= $characters[rand(0, strlen($characters) - 1)];
//         }

//         // Vérifie si le code existe déjà via le modèle
//         $exists = PaiementEnAttente::where('code', $randomString)->exists();

//     } while ($exists);

//     return $randomString;
// }



public function reservation(Request $request)
{
    $request->validate([
        'voyage_id' => 'required|exists:voyages,id',
        'token' => 'required',
        'numero_place' => 'required|integer|min:1',
        'id_arret_voayage' => 'required|integer|min:1',
    ]);

    $id = $request->input('voyage_id');
    $voyage = Voyage::find($id);
    if (!$voyage) {
        return response()->json([
            'message' => 'Voyage non trouvé',
        ], 404);
    }
    
    $id_arret_voayage = $request->input('id_arret_voayage');
    $arret_voyages = ArretVoyage::find($id_arret_voayage);
    if (!$arret_voyages) {
        return response()->json([
            'message'=> 'Arret voyage non trouvé',
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
    
    $codePaiement = $this->generateRandomString();
    
    $verifier = PaiementEnAttente::where('code', $codePaiement)->first();
    
    if ($verifier) {
        return response()->json([
            'success' => false,
            'message' => 'Cette demande de paiement existe déjà.'
        ], 400); // 409 = conflit
    }
    // return response()->json([
    //           'message' => 'Voyage non trouvé',
    //       ], 404);
    // $verifier = PaiementEnAttente::where('voyage_id', $request->voyage_id)->where('numero_place', $request->numero_place)->first();
    // if ($verifier) {
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Erreure cette place pour ce voyage'
    //     ], 400); // 409 = conflit
    // }

        $paiement = new PaiementEnAttente();
        $paiement->utilisateur_id = $utilisateur->id;
        $paiement->voyages_id = $voyage->id;
        $paiement->numero_place = $request->numero_place;
        $paiement->montant =$arret_voyages->montant;
        $paiement->code_paiement = $codePaiement;
        $paiement->id_arret_voayage = $id_arret_voayage;
        $paiement->statut = 3;
        // return response()->json([
        //     'success'=> true,
        //     'message'=> $paiement
        //     ], 200);
        $paiement->save();

         $data = [
            'code_paiement' => $codePaiement,
            //  'credential_id' => "llnal6ched", // code unique donnee pour mes acces a la plateforme
             'nom_usager' => $utilisateur->nom,
             'prenom_usager' => $utilisateur->prenom,
             'telephone' => $utilisateur->telephone,
             'email' => $utilisateur->email,
             'libelle_article' => "test fsfd zfdzdf efzee edfdezf",
             'quantite' => 1,
             'montant' => $arret_voyages->montant,
             'lib_order' => "test efzef edfzef efezf",
            'Url_Logo' =>  asset('photo_personnel/1758024064_logo_bus.png'),
            'pay_fees' => 1,
            'Url_Retour' => 'https://127.0.0.1:8000/login_connexion',
            'Url_Callback' => 'https://127.0.0.1:8000/api/retour_du_paiement',
            // 'Url_Retour' => 'https://127.0.0.1:8000/',
            // 'Url_Callback' => route('retour_du_paiement'),
        ];
    
        // $reponse = Http::post('https://rest-airtime.paysecurehub.com/api/payhub-ws/build-away', $data);
        $reponse = Http::withHeaders(['MerchantId' => 'llnal6ched', 'ApiKey' => 'shk_nDgSnvDpGa9ZEvtruZzxpO7gaSfP9qOJCfyh'])
                ->post('http://rest-airtime.paysecurehub.com/api/payhub-ws/build-away', $data);

        $ResJSON = $reponse->json();
            //     return response()->json([
            //    'success' => false,
            //    'message' => 'teste',
            //    'data'=> $ResJSON,
            //    'response'=> $reponse,
            //    'code'  =>$codePaiement,
            //    'montant'=>$voyage->montant,
            //    'body'=>$data
            //      ], 200); // 409 = conflit

        if ($reponse->status()===200) {
            if ($ResJSON['code']===200){
                // Redirection sur le hub de paiement
                if (!empty($ResJSON['url'])){
                     return response()->json([
                        "success"=> true,
                        "url"=> $ResJSON["url"],
                        ],200);
                    // return redirect()->away($ResJSON['url']);
                }else{
                    $mess = "Echec d'authentification pour acceder à la page demandée !";
                    // toas($mess,'success');
                    // return redirect()->back();
                    return response()->json([
                        "success"=> true,
                        "message"=> $mess
                        ],200);
                }
            }else{
            return response()->json([
            'success' => false,
            'message' => $ResJSON['message']
        ]);
            }
        }else{
            $mess = 'Une erreur inattendue s\'est produite, verifier que vous ' .
            'avez accès à internet, puis reéssayer. erreur ' . $reponse->status().', impossible de joindre l\'hôte !';
            // toast($mess,'error');
            return redirect()->back();
        }

    // // Enregistrer la réservation
    // $reservation = new Reservation();
    // $reservation->voyages_id = $voyage->id;
    // $reservation->utilisateurs_id = $utilisateur->id;
    // $reservation->numero_place = $request->numero_place;
    // $reservation->save();

    // return response()->json([
    //     'message' => 'Réservation effectuée avec succès',
    //     'voyage' => $voyage,
    //     'bus' => $bus,
    //     'utilisateur' => $utilisateur,
    //     'reservation' => $reservation,
    // ], 201);
}


// public function recu_reservation(Request $request, $token)
// {
//     // Récupérer l'utilisateur via son token
//     $utilisateur = Utilisateur::where('token', $token)->first();

//     if (!$utilisateur) {
//         return response()->json([
//             'status' => false,
//             'message' => 'Utilisateur non trouvé',
//         ], 404);
//     }
//     $reservations = Reservation::with([
//     'voyage.compagnie',
//     // 'voyage.itineraire',
//     // 'voyage.info_user',
//     // 'voyage.bus',
//     // 'voyage.chauffeur',
//     // 'voyage.gare',
//     'voyage.arretvoyages',
//     'voyage.arretvoyages.arret'
// ])
// ->where('utilisateurs_id', $utilisateur->id)
// ->get();

//     return response()->json([
//         'status' => true,
//         'reservations' => $reservations,
//         'utilisateur' => $utilisateur,
//     ], 200);
// }


public function recu_reservation(Request $request, $token)
{
    // Récupérer l'utilisateur via son token
    $utilisateur = Utilisateur::where('token', $token)->first();

    if (!$utilisateur) {
        return response()->json([
            'status' => false,
            'message' => 'Utilisateur non trouvé',
        ], 404);
    }

    // Charger les réservations avec les relations utiles
    $reservations = Reservation::with([
        'voyage.compagnie',
        'voyage.arretvoyages',
        'voyage.arretvoyages.arret'
    ])
    ->where('utilisateurs_id', $utilisateur->id)
    ->get();

    // Ajouter un "titre/objet" personnalisé à chaque réservation
    $reservations = $reservations->map(function ($reservation) {
        $compagnie = $reservation->voyage->compagnie->nom_complet_compagnies  ?? 'Compagnie inconnue';
        $depart = $reservation->voyage->arretvoyages->first()->arret->nom ?? 'Départ inconnu';
        $arrivee = $reservation->voyage->arretvoyages->last()->arret->nom ?? 'Arrivée inconnue';

        $reservation->objet = "Réservation #{$reservation->id} – {$compagnie} ({$depart} → {$arrivee})";

        return $reservation;
    });

    return response()->json([
        'status' => true,
        'reservations' => $reservations,
        'utilisateur' => $utilisateur,
    ], 200);
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


//liste des gare d'une compagnie 
public function listeGare(Request $request , $id)
{
    $compagnie = Compagnies::with([
        // 'jourOuvert',
        // 'jourFermeture',
        'ville',
    ])->where('id', $id)->first();

    if (!$compagnie) {
        return response()->json([
            'message' => 'Compagnie non trouvée',
        ], 404);
    }
    $liste_gares = gare::with([
        'ville',
        'jourOuvert',
        'jourFermeture',
    ])->where('compagnie_id', $id)->get();
    return response()->json([
        'message' => 'Liste des gares',
        'compagnie' => $compagnie,
        'liste_gares' => $liste_gares,
    ], 200);
}

//liste des voyage
public function listeVoyage_avec_itineraire(Request $request, $id)
{
    $itinerary = Itineraire::with([
        'voyages' => function($query) {
            $query->with([
                'bus' => function($q) {
                    $q->with(['configurationPlace.placeconfigbussave']);
                },
                'chauffeur',
                'compagnie',
                'gare',
                'info_user'
            ]);
        },
        'ville',
        'compagnie',
        'gare'
    ])->findOrFail($id);

    // Format the response to include bus configuration and place configurations
    $formattedVoyages = $itinerary->voyages->map(function($voyage) {
        $voyageData = $voyage->toArray();
        
        if ($voyage->bus && $voyage->bus->configurationPlace) {
            $voyageData['bus']['configuration'] = $voyage->bus->configurationPlace;
            $voyageData['bus']['configuration']['places'] = $voyage->bus->configurationPlace->placeconfigbussave;
        }
        
        return $voyageData;
    });

    return response()->json([
        'message' => 'Liste des voyages pour l\'itinéraire avec configurations',
        'itinerary' => $itinerary,
        'voyages' => $formattedVoyages
    ], 200);
}

// Liste des itinéraires avec leurs voyages, arrêts et gares associées pour une gare donnée
public function listeVoyage_avec_itineraire_avec_ville(Request $request, $id)
{
    $gares = gare::with([
        'ville',
        'jourOuvert',
        'jourFermeture',
    ])->where('id', $id)->first();
    if (!$gares) {
        return response()->json([
            'message' => 'Gare non trouvée',
        ], 404);
    }
    $itineraries = Itineraire::with([
        'ville',
        'gare.ville', // Charge la gare avec sa ville associée
        'voyages' => function($query) {
            $query->with([
                'arretVoyages' => function($q) {
                    $q->with(['arret' => function($a) {
                        $a->with(['gare.ville']); // Charge la gare et sa ville pour chaque arrêt
                    }]);
                }
            ]);
        },
        'arrets' => function($query) {
            $query->with(['gare.ville']); // Charge les arrêts avec leur gare et ville
        }
    ])
    ->where('gare_id', $id)
    ->get();

    // Formater la réponse pour inclure les informations nécessaires
    $formattedItineraries = $itineraries->map(function($itinerary) {
        return [
            'id' => $itinerary->id,
            'titre' => $itinerary->titre,
            'estimation' => $itinerary->estimation,
            'ville' => $itinerary->ville,
            'gare' => $itinerary->gare,
            'voyages' => $itinerary->voyages->map(function($voyage) {
                return [
                    'id' => $voyage->id,
                    'heure_depart' => $voyage->heure_depart,
                    'date_depart' => $voyage->date_depart,
                    'arret_voyages' => $voyage->arretVoyages->map(function($arretVoyage) {
                        return [
                            'id' => $arretVoyage->id,
                            'montant' => $arretVoyage->montant,
                            'arret' => $arretVoyage->arret ? [
                                'id' => $arretVoyage->arret->id,
                                'nom' => $arretVoyage->arret->nom,
                                'gare' => $arretVoyage->arret->gare ? [
                                    'id' => $arretVoyage->arret->gare->id,
                                    'nom_gare' => $arretVoyage->arret->gare->nom_gare,
                                    'ville' => $arretVoyage->arret->gare->ville
                                ] : null
                            ] : null
                        ];
                    })
                ];
            })
        ];
    });

    return response()->json([
        'message' => 'Liste des itinéraires avec leurs voyages, arrêts et gares',
        'gares' => $gares,
        'itineraries' => $formattedItineraries,
    ], 200);
}


}



