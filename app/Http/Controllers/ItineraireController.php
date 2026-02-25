<?php

namespace App\Http\Controllers;

use App\Models\Arret;
use App\Models\gare;
use App\Models\ville;

use App\Models\itineraire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArretVoyage;
use App\Models\TarificationMontantVoyage;
use Illuminate\Support\Facades\Auth;

class ItineraireController extends Controller
{
// public function index()
// {
//     $user = Auth::user(); // Récupère l'utilisateur connecté

//     // Récupérer tous les voyages de l'utilisateur
//     $voyages = Itineraire::where('user_id', $user->id)
//                  ->with('arrets') // si tu veux récupérer les arrêts associés
//                  ->get();

//     return view("compagnie.itineraire.index", compact('voyages'));
// }

public function index(Request $request)
{
    $user = Auth::user();
    $itineraires = collect();
    $villes = Ville::all(); // Récupérer toutes les villes pour le filtre

    // Récupérer les paramètres de filtre
    $dateDebut = $request->get('date_debut');
    $dateFin = $request->get('date_fin');
    $status = $request->get('status');
    $villeId = $request->get('ville_id'); // Ajout du filtre par ville

    // Vérifier si l'utilisateur a un profil info_user
    if ($user->info_user) {
        // Si l'utilisateur est associé à une compagnie
        if ($user->info_user->compagnie) {
            $compagnieId = $user->info_user->compagnie->id;
            $query = Itineraire::where('compagnie_id', $compagnieId)
                ->with(['arrets', 'ville', 'gare']); // Charger les relations nécessaires
            
            // Appliquer les filtres
            if ($dateDebut) {
                $query->whereDate('created_at', '>=', $dateDebut);
            }
            if ($dateFin) {
                $query->whereDate('created_at', '<=', $dateFin);
            }
            if ($status !== null && $status !== '') {
                $query->where('status', $status);
            }
            if ($villeId) {
                $query->where('ville_id', $villeId);
            }
            
            $itineraires = $query->latest()->get();
        } 
        // Si l'utilisateur est associé à une gare
        elseif ($user->info_user->gare) {
            $gareId = $user->info_user->gare->id;
            // Récupérer les itinéraires qui ont cette gare comme point de départ ou d'arrêt
            $query = Itineraire::with('arrets')->where('gare_id', $gareId)
                ->orWhereHas('arrets', function($query) use ($gareId) {
                    $query->where('gare_id', $gareId);
                })
                ->with(['arrets', 'ville', 'gare']); // Charger les relations nécessaires
            
            // Appliquer les filtres
            if ($dateDebut) {
                $query->whereDate('created_at', '>=', $dateDebut);
            }
            if ($dateFin) {
                $query->whereDate('created_at', '<=', $dateFin);
            }
            if ($status !== null && $status !== '') {
                $query->where('status', $status);
            }
            if ($villeId) {
                $query->where('ville_id', $villeId);
            }
            
            $itineraires = $query->get();
        }
    }
    
    // Si aucun filtre n'a été appliqué (utilisateur sans compagnie ni gare)
    if ($itineraires->isEmpty()) {
        $query = Itineraire::with('arrets')->where('user_id', $user->id)
            ->with(['arrets', 'ville', 'gare']);
            
        // Appliquer les filtres
        if ($dateDebut) {
            $query->whereDate('created_at', '>=', $dateDebut);
        }
        if ($dateFin) {
            $query->whereDate('created_at', '<=', $dateFin);
        }
        if ($status !== null && $status !== '') {
            $query->where('status', $status);
        }
        if ($villeId) {
            $query->where('ville_id', $villeId);
        }
        
        $itineraires = $query->latest()->get();
    }
    // dd($itineraires);
    // Ajouter les attributs calculés
    $itineraires->transform(function ($itineraire) {
        $itineraire->total_montant = $itineraire->arrets->sum('montant');
        $itineraire->nombre_arrets = $itineraire->arrets->count();
        return $itineraire;
    });

    return view("compagnie.itineraire.index", compact('itineraires', 'villes'));
}





//     public function store(Request $request)
//     {
//     $user = Auth::user();
//     // Validation
//     $validated = $request->validate([
//     'ville_id' => $request->has('gare_id') ? 'required|exists:villes,id' : 'nullable|exists:villes,id',
//     'estimation'   => 'nullable',
//     'titre'        => 'nullable|string|max:255',
//     'gare_id'      => 'nullable|exists:gares,id',
//     'gares'      => 'nullable|array',
//         'gares.*.id' => 'required|exists:gares,id'
//     ], [
//         'ville_id.exists'     => 'La ville sélectionnée est invalide.',
//         'titre.max'           => 'Le titre ne doit pas dépasser 255 caractères.',
//     ]);

// //     $gareIds = collect($validated['gares'])->pluck('id');

// // $garesDetails = Gare::whereIn('id', $gareIds)
// //     ->with('ville')
// //     ->get();

// // foreach ($garesDetails as $gare) {

// //     // départ (provenant du formulaire)
// //     $villeDepart = $request->ville_id;

// //     // arrivée
// //     $villeArrivee = $gare->ville->id ?? null;

// //     // recherche du prix
// //     $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
// //         ->where('ville_arrivee_id', $villeArrivee)
// //         ->where('est_actif', 1)
// //         ->first();

// //     dump([
// //         'ville_de_depart' => $villeDepart,
// //         'gare' => $gare->nom_gare ?? null,
// //         'id_gare' => $gare->id ?? null,
// //         'ville_arrive' => $gare->ville->nom_ville ?? null,
// //         'id_ville_arrive' => $gare->ville->id ?? null,
// //         'montant' => $tarif->montant ?? null,   // <-- prix affiché ici
// //     ]);
// // }

// // dd('fin');
// // 

//         if (empty($validated['ville_id']) && empty($validated['gare_id'])) {
//     return back()->withErrors(['Erreur : La ville de départ ou la gare de départ est obligatoire.'])->withInput();
// }

// // Si ville_id n'est pas défini mais gare_id l'est, récupérez la ville de la gare
// if (empty($validated['ville_id']) && !empty($validated['gare_id'])) {
//     $gare = Gare::find($validated['gare_id']);
//     if ($gare) {
//         $validated['ville_id'] = $gare->ville_id;
//     }
// }

//         // Récupération de info_user_id
//         $infoUserId = $user->info_user->id ?? null;

//         if (!$infoUserId) {
//             return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
//         }
            

//               $voyage = itineraire::create([
//             'user_id'      => $user->id,
//             'info_user_id' => $infoUserId,
//             'ville_id'      => $request->ville_id,
//             'estimation'   => $request->estimation,
//             'titre'        => $request->titre,
//             'status'       => 1,
//             'compagnie_id' => $user->info_user?->gare?->compagnie?->id
//                   ?? $user->info_user?->compagnie?->id
//                   ?? 0, // valeur par défaut si tout est null
//             // 'gare_id'      => $user->info_user->gare->id ?? null,
//             'gare_id' => $validated['gare_id'] ?? $user->info_user->gare->id ?? null,
//         ]);

//         // Vérifier si le voyage a bien été créé
//         if (!$voyage || !$voyage->id) {
//             return back()->withErrors(['Erreur : Le voyage n\'a pas été créé correctement.']);
//         }


//  // ------------------ CREATION ARRETS ------------------
//     if ($request->has('gares')) {

//         foreach ($request->gares as $gareData) {

//             $gare = Gare::with('ville')->find($gareData['id']);
//             if (!$gare) continue;



//             $villeDepart = $validated['ville_id'];
//             $villeArrivee = $gare->ville->id ?? null;
//             $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
//                         ->where('ville_arrivee_id', $villeArrivee)
//                         ->where('est_actif', 1)
//                         ->first();

//             // ------------------ ERREUR ICI ------------------
//             if (!$tarif) {

//               // Récupérer les modèles des villes pour afficher le nom
// $villeDepartNom = Ville::find($villeDepart)->nom_ville ?? "inconnue";
// $villeArriveeNom = Ville::find($villeArrivee)->nom_ville ?? "inconnue";

// return back()->withErrors([
//     "Aucun tarif n’a été trouvé entre la ville $villeDepartNom et $villeArriveeNom."
// ])->withInput();
//             }

//             // Rechercher le tarif
            
      

//             // ------------------ CREER ARRET ------------------
//             Arret::create([
//                 'itineraire_id'  => $voyage->id,
//                 'info_user_id'   => $infoUserId,
//                 'gares_id'       => $gare->id,
//                 'id_tarrification_voyage' => $tarif->id,
//                 'montant'        => $tarif->montant,
//             ]);
//         }
//     }
//         return redirect()->route('itineraire.index')->with('success', 'Voyage enregistré avec succès.');
//     }

public function store(Request $request)
{
    $user = Auth::user();

    // Validation
    $validated = $request->validate([
        'ville_id' => $request->has('gare_id') ? 'required|exists:villes,id' : 'nullable|exists:villes,id',
        'estimation' => 'nullable',
        'titre' => 'required|string|max:255',
        'gare_id' => 'nullable|exists:gares,id',
        'gares' => 'nullable|array',
        'gares.*.id' => 'required|exists:gares,id'
    ],[
        'ville_id.exists' => 'La ville sélectionnée est invalide.',
        'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
        'gare_id.exists' => 'La gare sélectionnée est invalide.',
        'gares.*.id.exists' => 'Une des gares sélectionnées est invalide.',
        'titre.required' => 'Le titre est obligatoire.',
        'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
    ]);

    // Ville obligatoire
    if (empty($validated['ville_id']) && empty($validated['gare_id'])) {
        return back()->withErrors(['Erreur : La ville ou la gare de départ est obligatoire.'])->withInput();
    }

    // Si gare_id est définie mais pas ville_id
    if (empty($validated['ville_id']) && !empty($validated['gare_id'])) {
        $gare = Gare::find($validated['gare_id']);
        if ($gare) {
            $validated['ville_id'] = $gare->ville_id;
        }
    }

    $villeDepart = $validated['ville_id'];

    // -------------------------------
    // 1️⃣ Vérifier les tarifs AVANT d'enregistrer l’itinéraire
    // -------------------------------
    if ($request->has('gares')) {
        foreach ($request->gares as $gareData) {

            $gare = Gare::with('ville')->find($gareData['id']);
            if (!$gare) continue;

            $villeArrivee = $gare->ville->id ?? null;
            if($user->info_user->compagnie){
                // dd($user->info_user->compagnie);
                $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
                        ->where('ville_arrivee_id', $villeArrivee)
                        //->where('est_actif', 1)
                        ->where('compagnie_id', $user->info_user->compagnie->id)
                        ->first();
                        // dd('testcomapgnie', $tarif ,$user->info_user->compagnie);
            }elseif($user->info_user->gare->compagnie){
                $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
                        ->where('ville_arrivee_id', $villeArrivee)
                        // ->where('est_actif', 1)
                        ->where('compagnie_id', $user->info_user->gare->compagnie->id)
                        ->first();
            }else{
                dd('Rien entre les deux');
            }
        //    dd($user->info_user->compagnie , $user->info_user->gare->compagnie);
            // $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
            //             ->where('ville_arrivee_id', $villeArrivee)
            //             ->where('est_actif', 1)->where('compagnie_id', $user->info_user->compagnie_id)
            //             ->first();
        //    dd($tarif);
           if($tarif){
            if($tarif->est_actif == false){
                $villeDepartNom = Ville::find($villeDepart)->nom_ville ?? "inconnue";
                $villeArriveeNom = Ville::find($villeArrivee)->nom_ville ?? "inconnue";
                return back()->withErrors([
                    "Le tarif entre la ville $villeDepartNom et $villeArriveeNom est desactif veuillez le modifier ou le reactiver"
                ])->withInput();
            }
        }
            if (!$tarif) {
                $villeDepartNom = Ville::find($villeDepart)->nom_ville ?? "inconnue";
                $villeArriveeNom = Ville::find($villeArrivee)->nom_ville ?? "inconnue";
                return back()->withErrors([
                    "Aucun tarif n’a été trouvé entre la ville $villeDepartNom et $villeArriveeNom."
                ])->withInput();
            }
        }
    }

    // -------------------------------
    // 2️⃣ Tous les tarifs sont OK → créer l’itinéraire
    // -------------------------------
    $infoUserId = $user->info_user->id ?? null;

    if (!$infoUserId) {
        return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
    }

    $voyage = Itineraire::create([
        'user_id'      => $user->id,
        'info_user_id' => $infoUserId,
        'ville_id'     => $validated['ville_id'],
        'estimation'   => $request->estimation,
        'titre'        => $request->titre,
        'status'       => 1,
        'compagnie_id' => $user->info_user?->gare?->compagnie?->id
                        ?? $user->info_user?->compagnie?->id
                        ?? 0,
        'gare_id'      => $validated['gare_id'] ?? $user->info_user->gare->id ?? null,
    ]);

    if (!$voyage || !$voyage->id) {
        return back()->withErrors(['Erreur : Le voyage n\'a pas été créé correctement.']);
    }


    // -------------------------------
    // 3️⃣ Créer les arrêts (tarifs déjà validés)
    // -------------------------------
    if ($request->has('gares')) {

        foreach ($request->gares as $gareData) {

            $gare = Gare::with('ville')->find($gareData['id']);

            $villeArrivee = $gare->ville->id ?? null;

            $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
                        ->where('ville_arrivee_id', $villeArrivee)
                        ->where('est_actif', 1)
                        ->where('compagnie_id', $user->info_user?->gare?->compagnie?->id
                        ?? $user->info_user?->compagnie?->id
                        ?? 0)
                        ->first();

    //            dd([
    //     'itineraire_id' => $voyage->id,
    //     'info_user_id'  => $infoUserId,
    //     'gares_id'      => $gare->id,
    //     'tarif_id'      => $tarif?->id,
    //     'montant'       => $tarif?->montant,
    // ]);

            Arret::create([
                'itineraire_id'  => $voyage->id,
                'info_user_id'   => $infoUserId,
                'gares_id'       => $gare->id,
                'id_tarrification_voyage' => $tarif->id,
                'montant'        => $tarif->montant,
            ]);

            
        }
    }

    return redirect()->route('itineraire.index')->with('success', 'Voyage enregistré avec succès.');
}


// public function update(Request $request, $id)
// {
//     $user = Auth::user();
//     // Validation
//     $validated = $request->validate([
//     'ville_id' => $request->has('gare_id') ? 'required|exists:villes,id' : 'nullable|exists:villes,id',
//     'estimation'   => 'nullable',
//     'titre'        => 'nullable|string|max:255',
//     'gare_id'      => 'nullable|exists:gares,id',
//     'gares'      => 'nullable|array',
//         'gares.*.id' => 'required|exists:gares,id',
//         // 'arrets'       => 'nullable|array',
//         // 'arrets.*.nom' => 'required_with:arrets|string|max:255',
//         // 'arrets.*.id'  => 'nullable|exists:arrets,id', // important si tu passes des IDs
//     ], [
//         'ville_id.exists'     => 'La ville sélectionnée est invalide.',
//         'titre.max'           => 'Le titre ne doit pas dépasser 255 caractères.',
//         // 'arrets.*.nom.required_with' => 'Le nom de chaque arrêt est obligatoire lorsque des arrêts sont ajoutés.',
//     ]);


//     dd($validated);
//     // if ($validated['ville_id'] === null) {
//     //     return back()->withErrors(['Erreur : La ville de départ est obligatoire.'])->withInput();
//     // }

//             if (empty($validated['ville_id']) && empty($validated['gare_id'])) {
//     return back()->withErrors(['Erreur : La ville de départ ou la gare de départ est obligatoire.'])->withInput();
// }

// // Si ville_id n'est pas défini mais gare_id l'est, récupérez la ville de la gare
// if (empty($validated['ville_id']) && !empty($validated['gare_id'])) {
//     $gare = Gare::find($validated['gare_id']);
//     if ($gare) {
//         $validated['ville_id'] = $gare->ville_id;
//     }
// }

//     // Récupération de info_user_id
//     $infoUserId = $user->info_user->id ?? null;
//     if (!$infoUserId) {
//         return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
//     }

//     // Récupérer l’itinéraire
//     $voyage = Itineraire::findOrFail($id);

//     // Mise à jour du voyage
//     $voyage->update([
//         'ville_id'     => $request->ville_id,
//         'estimation'   => $request->estimation,
//         'titre'        => $request->titre,
//         'compagnie_id' => $user->info_user?->gare?->compagnie?->id
//                         ?? $user->info_user?->compagnie?->id
//                         ?? 0,
//         'gare_id'      => $user->info_user->gare->id ?? null,
//     ]);

//  // Supprimer tous les arrêts existants pour éviter doublons
//     $voyage->arrets()->delete();

//     // Créer tous les arrêts depuis le formulaire
//     if ($request->has('gares')) {
//         foreach ($request->gares as $gareData) {
//             Arret::create([
//                 'itineraire_id' => $voyage->id,
//                 'info_user_id'  => $infoUserId,
//                 'gares_id'      => $gareData['id'],
//             ]);
//         }
//     }
    
//     return redirect()->route('itineraire.index')->with('success', 'Voyage mis à jour avec succès.');
// }

public function update(Request $request, $id)
{
    $user = Auth::user();

    // Validation
    $validated = $request->validate([
        'ville_id' => $request->has('gare_id') ? 'required|exists:villes,id' : 'nullable|exists:villes,id',
        'gare_id'     => 'required|exists:gares,id',
        'estimation'  => 'nullable',
        'titre'       => 'required|string|max:255',
        // 'gares'       => 'required|array|min:1',
        // 'gares.*.id'  => 'required|exists:gares,id',
        'gares'      => 'nullable|array',
    // 'gares.*.id' => 'required_with:gares|exists:gares,id',
        'gares.*.id' => 'required|exists:gares,id',
    ], [
        'gare_id.exists'   => 'La gare sélectionnée est invalide.',
        'titre.max'        => 'Le titre ne doit pas dépasser 255 caractères.',
        'titre.required' => 'Le titre est obligatoire.',
        'ville_id.required' => 'La ville de départ est obligatoire.',
        'gare_id.required' => 'La gare de départ est obligatoire.',
        'estimation.required' => 'La durée du trajet est obligatoire.',
        'titre.required' => 'Le titre est obligatoire.',
        'gares.required' => 'Veuillez ajouter au moins une gare d\'arrêt.',
        'gares.min' => 'Veuillez ajouter au moins une gare d\'arrêt.',
        'gares.*.id.required' => 'Veuillez ajouter au moins une gare d\'arrêt.',
        'gares.*.id.exists' => 'La gare sélectionnée est invalide.',
        'gares.*.id.unique' => 'La gare sélectionnée est invalide.',
    ],);
    // dd($validated);
    
    // Récupération de info_user_id
    $infoUserId = $user->info_user->id ?? null;
    if (!$infoUserId) {
        return back()->withErrors(['Erreur info_user_id manquant pour l\'utilisateur.']);
    }

    // Récupérer la gare sélectionnée
    $gare = Gare::findOrFail($validated['gare_id']);

    // Récupérer l'itinéraire
    $voyage = Itineraire::findOrFail($id);

    // Mise à jour du voyage
    $voyage->update([
        'ville_id'     => $gare->ville_id,
        'gare_id'      => $gare->id,
        'estimation'   => $request->estimation,
        'titre'        => $request->titre,
        'compagnie_id' => $user->info_user?->gare?->compagnie?->id
                        ?? $user->info_user?->compagnie?->id
                        ?? 0,
    ]);
    // dd($validated);
    // Supprimer tous les arrêts existants
    $voyage->arrets()->delete();
    // dd($validated['gares']);
    // Créer les nouveaux arrêts
    // if (isset($validated['gares'])) {
    //     foreach ($validated['gares'] as $gareData) {
    //         // Ne pas créer d'arrêt si c'est la gare de départ
    //         if ($gareData['id'] != $gare->id) {
    //             Arret::create([
    //                 'itineraire_id' => $voyage->id,
    //                 'info_user_id'  => $infoUserId,
    //                 'gares_id'      => $gareData['id'],
    //             ]);
    //         }
    //     }
        
    // }
//     if ($request->has('gares')) {
//     foreach ($request->gares as $gareData) {
//         Arret::create([
//             'itineraire_id' => $voyage->id,
//             'info_user_id'  => $infoUserId,
//             'gares_id'      => $gareData['id'],
//         ]);
//     }
// }

    if ($request->has('gares')) {

        foreach ($request->gares as $gareData) {

            $gare = Gare::with('ville')->find($gareData['id']);
            if (!$gare) continue;

            $villeDepart = $validated['ville_id'];
            $villeArrivee = $gare->ville->id ?? null;

            // Rechercher le tarif
            $tarif = TarificationMontantVoyage::where('ville_depart_id', $villeDepart)
                        ->where('ville_arrivee_id', $villeArrivee)
                        ->where('est_actif', 1)
                        ->where('compagnie_id', $user->info_user?->gare?->compagnie?->id
                        ?? $user->info_user?->compagnie?->id
                        ?? 0)
                        ->first();

            // ------------------ ERREUR ICI ------------------
            if (!$tarif) {

                // Optionnel: supprimer le voyage créé avant retour (si logique métier)
                // $voyage->delete();

              // Récupérer les modèles des villes pour afficher le nom
            $villeDepartNom = Ville::find($villeDepart)->nom_ville ?? "inconnue";
            $villeArriveeNom = Ville::find($villeArrivee)->nom_ville ?? "inconnue";

            return back()->withErrors([
                "Aucun tarif n’a été trouvé entre la ville $villeDepartNom et $villeArriveeNom."
            ])->withInput();
            }else {
                // ------------------ CREER ARRET ------------------
            Arret::create([
                'itineraire_id'  => $voyage->id,
                'info_user_id'   => $infoUserId,
                'gares_id'       => $gare->id,
                'id_tarrification_voyage' => $tarif->id,
                'montant'        => $tarif->montant,
            ]);
            }

            
        }
    }
    
    return redirect()->route('itineraire.index')->with('success', 'Itinéraire mis à jour avec succès.');
}


    public function show($id)
    {
        $voyage = Itineraire::with([
            'arrets.gare.ville',
            'ville',
            'gare.ville',
            'arrets' => function($query) {
                $query->orderBy('created_at');
            }
        ])->findOrFail($id);
        
        // Récupérer la ville de départ (premier arrêt)
        $villeDepart = $voyage->gare->ville ?? null;
        
        // Récupérer la ville d'arrivée (dernier arrêt)
        $villeArrivee = $voyage->arrets->last() ? $voyage->arrets->last()->gare->ville : null;
        
        return view('compagnie.itineraire.detail', compact('voyage', 'villeDepart', 'villeArrivee'));
    }

// public function edit($id)
// {
//     $itineraire = itineraire::with('arrets')->findOrFail($id);
//     return view('compagnie.itineraire.edit', compact('itineraire'));
// }

//     public function edit($id)
// {
//     $userId = Auth::id();
//     // Récupération de la ville de départ via la gare de l'utilisateur
//     $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
//                 ->where('info_users.user_id', $userId)
//                 ->select('gares.ville_id')
//                 ->first();
//     $villeId = $gare->ville_id ?? null;
//     // Pour afficher toutes les villes si besoin dans un select
//     $villes = \App\Models\Ville::orderBy('nom_ville')->get();
//     // Pour afficher toutes les gares si besoin dans un select
//     $gars = null;
    
//     if ($villeId == null) {
//         $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
//         $gars = gare::where('compagnie_id', $compagnie->id)->get();
//     }

//     $itineraire = itineraire::with('arrets')->findOrFail($id);

//     return view("compagnie.itineraire.edit", compact("villes", "villeId" , "gars","itineraire"));
// }

public function edit($id)
{
    // $userId = Auth::id();
    // Récupération de la ville de départ via la gare de l'utilisateur
    // $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
    //             ->where('info_users.user_id', $userId)
    //             ->select('gares.ville_id')
    //             ->first();
    // $villeId = $gare->ville_id ?? null;
    //   $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
    // if ($compagnie) {
    //     // Gérer le cas où la compagnie n'existe pas
    //     $gares = gare::where('compagnie_id', $compagnie->id)->get();
    // }else{
    // $gares = gare::where('info_user_id', $userId)->get();
    // }
     $userconnecter = Auth::user();
    $userId = $userconnecter->id;
    // Récupération de la ville de départ via la gare de l'utilisateur
    $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
    if ($compagnie) {
        // Gérer le cas où la compagnie n'existe pas
        $gares = gare::where('compagnie_id', $compagnie->id)->get();
    }else{
        
    $adminUser = \App\Models\User::find($userconnecter->id_admin_creation);
    $compagnie = \App\Models\Compagnies::where('info_user_id', $adminUser->id)->first();
    // dd($adminUser , $compagnie);
    $gares = gare::where('info_user_id' ,'!=' ,$userconnecter->id)->where('compagnie_id', $compagnie->id)->get();
    }
    
    $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
    ->where('info_users.user_id', $userId)
    ->select('gares.ville_id' , 'gares.id' , 'gares.nom_gare')
    ->first();
    // dd($gares , $gare);
                
    $villeId = $gare->ville_id ?? null;
    // Pour afficher toutes les villes si besoin dans un select
    $villes = \App\Models\Ville::orderBy('nom_ville')->get();
    // Pour afficher toutes les gares si besoin dans un select
    // $gars = null;
    // if ($villeId == null) {
    //     $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
    //     if ($compagnie) {
    //         $gars = \App\Models\Gare::where('compagnie_id', $compagnie->id)->get();
    //     }
    // }
        $gars = null;
    
    if ($villeId == null) {
        $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
        $gars = gare::where('compagnie_id', $compagnie->id)->get();
    } 

    $itineraire = \App\Models\Itineraire::with('arrets')->findOrFail($id);

    // dd($gars , $villeId , $villes , $userId , $gare, $itineraire);

    return view("compagnie.itineraire.edit", compact("villes", "villeId", "gars", "itineraire" ,"gares" , "gare"));
}

public function create()
{ 
    $userconnecter = Auth::user();
    $userId = $userconnecter->id;
    // Récupération de la ville de départ via la gare de l'utilisateur
    $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
    if ($compagnie) {
        // Gérer le cas où la compagnie n'existe pas
        $gares = gare::where('compagnie_id', $compagnie->id)->get();
    }else{
        
    $adminUser = \App\Models\User::find($userconnecter->id_admin_creation);
    $compagnie = \App\Models\Compagnies::where('info_user_id', $adminUser->id)->first();
    // dd($adminUser , $compagnie);
    $gares = gare::where('info_user_id' ,'!=' ,$userconnecter->id)->where('compagnie_id', $compagnie->id)->get();
    }

    $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
                ->where('info_users.user_id', $userId)
                ->select('gares.ville_id')
                ->first();
                
                $villeId = $gare->ville_id ?? null;
                // Pour afficher toutes les villes si besoin dans un select
                $villes = \App\Models\Ville::orderBy('nom_ville')->get();
                // dd($gares , $compagnie , $userId , $gare , $villeId);
    // Pour afficher toutes les gares si besoin dans un select
    $gars = null;
    
    if ($villeId == null) {
        $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
        $gars = gare::where('compagnie_id', $compagnie->id)->get();
    } 
    // dd($gars , $villeId , $villes , $userId , $gare);
    return view("compagnie.itineraire.create", compact("villes", "villeId" , "gars" ,"gares"));
}

public function details($id)
{
    $gare = \App\Models\Gare::with('ville')->find($id);

    if (!$gare) {
        return response()->json(['error' => 'Gare introuvable'], 404);
    }

    return response()->json($gare);
}





    public function destroy($id)
{
    $chauffeur = itineraire::findOrFail($id);
    $chauffeur->status = 3; // Supprimé ou inactif
    $chauffeur->save();

    return redirect()->back()->with('success', 'Chauffeur supprimé avec succès.');
}

public function destroy_reactivation($id)
{
    $chauffeur = itineraire::findOrFail($id);
    $chauffeur->status = 1; // Réactivation
    $chauffeur->save();

    return redirect()->back()->with('success', 'Chauffeur réactivé avec succès.');
}

}
