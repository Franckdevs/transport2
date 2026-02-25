<?php

namespace App\Http\Controllers;

use App\Models\ArretVoyage;
use App\Models\gare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Arret;     // Importer le modèle Arret
use App\Models\Ville;     // Importer le modèle Ville
use App\Models\Voyage;    // Importer le modèle Voyage
use App\Models\Itineraire; // Importer le modèle Itineraire
use App\Models\Bus;       // Importer le modèle Bus (s'il existe)
use App\Models\Chauffeur; // Importer le modèle Chauffeur (s'il existe)
use App\Models\ConfigurationBus; // Importer le modèle ConfigurationBus
use App\Models\PlaceConfiguration; // Importer le modèle PlaceConfiguration
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class VoyageController extends Controller
{

    /**
     * Récupère les détails d'un bus avec sa configuration
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Récupère les détails d'un chauffeur
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChauffeurDetails($id)
    {
        try {
            $chauffeur = Chauffeur::find($id);
            
            if (!$chauffeur) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chauffeur non trouvé.'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $chauffeur->id,
                    'nom_complet' => $chauffeur->prenom . ' ' . $chauffeur->nom,
                    'telephone' => $chauffeur->telephone,
                    'adresse' => $chauffeur->adresse,
                    'numero_permis' => $chauffeur->numeros_permis,
                    'date_naissance' => $chauffeur->date_naissance,
                    'status' => $chauffeur->status,
                    'photo' => $chauffeur->photo,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des détails du chauffeur : ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des détails du chauffeur.'
            ], 500);
        }
    }
    
    /**
     * Récupère les détails d'un bus
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBusDetails($id)
    {
        try {
            $bus = Bus::with(['configurationPlace.placeconfigbussave'])->find($id);
            
            if (!$bus) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bus non trouvé.'
                ], 404);
            }

            // Construire l'URL complète de la photo si elle existe
            $photoUrl = null;
            if ($bus->photo_bus) {
                // Si le chemin contient déjà 'http', on le retourne tel quel
                if (strpos($bus->photo_bus, 'http') === 0) {
                    $photoUrl = $bus->photo_bus;
                } 
                // Sinon, on construit le chemin complet
                else {
                    // Nettoyer le chemin pour éviter les doublons
                    $cleanPath = ltrim($bus->photo_bus, '/');
                    $cleanPath = str_replace('buses/', '', $cleanPath);
                    $photoUrl = asset('buses/' . $cleanPath);
                }
            }

return response()->json([
                'success' => true,
                'data' => [
                    'bus' => [
                        'id' => $bus->id,
                        'nom_bus' => $bus->nom_bus,
                        'marque_bus' => $bus->marque_bus,
                        'modele_bus' => $bus->modele_bus,
                        'photo_bus' => $photoUrl,
                        'immatriculation_bus' => $bus->immatriculation_bus,
                        'photo_bus' => $photoUrl,
                        'description_bus' => $bus->description_bus,
                        'localisation_bus' => $bus->localisation_bus,
                        'configuration_place_buses_id' => $bus->configuration_place_buses_id,
                        'created_at' => $bus->created_at,
                        'updated_at' => $bus->updated_at
                    ],
                    'configuration' => $bus->configurationPlace ? [
                        'id' => $bus->configurationPlace->id,
                        'nom' => $bus->configurationPlace->nom,
                        'colonne' => $bus->configurationPlace->colonne,
                        'ranger' => $bus->configurationPlace->ranger,
                        'nombre_places' => $bus->configurationPlace->colonne * $bus->configurationPlace->ranger,
                        'created_at' => $bus->configurationPlace->created_at,
                        'updated_at' => $bus->configurationPlace->updated_at
                    ] : null,
                    'places' => $bus->configurationPlace ? $bus->configurationPlace->placeconfigbussave->map(function($place) {
                        return [
                            'id' => $place->id,
                            'numero_place' => $place->numero_place,
                            'colonne' => $place->colonne,
                            'rangee' => $place->rangee,
                            'type_place' => $place->type_place,
                            'prix' => $place->prix,
                            'statut' => $place->statut,
                            'created_at' => $place->created_at,
                            'updated_at' => $place->updated_at
                        ];
                    }) : []
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des informations du bus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Voyage::with(['itineraire', 'itineraire.ville', 'itineraire.arrets.gare.ville', 'info_user', 'bus', 'chauffeur', 'arretVoyages', 'gare']);

        // Vérifier si l'utilisateur a un profil info_user
        if ($user->info_user) {
            // Si l'utilisateur est associé à une compagnie
            if ($user->info_user->compagnie) {
                $compagnieId = $user->info_user->compagnie->id;
                $query->where('compagnie_id', $compagnieId);
            } 
            // Si l'utilisateur est associé à une gare
            elseif ($user->info_user->gare) {
                $gareId = $user->info_user->gare->id;
                $query->where('gare_id', $gareId);
            }
        }

        // Appliquer les filtres
        if ($request->filled('date_debut')) {
            $query->whereDate('date_depart', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_depart', '<=', $request->date_fin);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtre par ville de départ
        if ($request->filled('ville_depart_id')) {
            $query->whereHas('itineraire.ville', function($q) use ($request) {
                $q->where('id', $request->ville_depart_id);
            });
        }

        // Filtre par ville d'arrivée (dernier arrêt uniquement)
        if ($request->filled('ville_arrivee_id')) {
            $query->whereHas('itineraire.arrets', function($q) use ($request) {
                $q->whereHas('gare.ville', function($subQ) use ($request) {
                    $subQ->where('id', $request->ville_arrivee_id);
                })->whereIn('id', function($subQuery) {
                    // Récupérer uniquement les derniers arrêts de chaque itinéraire
                    $subQuery->selectRaw('MAX(id) as id')
                            ->from('arrets')
                            ->groupBy('itineraire_id');
                });
            });
        }

        // Filtre par ville d'arrêt
        if ($request->filled('ville_arret_id')) {
            $query->whereHas('itineraire.arrets', function($q) use ($request) {
                $q->whereHas('gare.ville', function($subQ) use ($request) {
                    $subQ->where('id', $request->ville_arret_id);
                });
            });
        }

        // Récupérer les voyages avec les filtres appliqués
        $voyages = $query->orderBy('id', 'desc')->get();

        // Récupérer toutes les villes pour les filtres
        $villes = \App\Models\Ville::orderBy('nom_ville')->get();

        // Formater les dates
        foreach ($voyages as $voyage) {
            $voyage->heure_depart = \Carbon\Carbon::parse($voyage->heure_depart);
            $voyage->date_depart = \Carbon\Carbon::parse($voyage->date_depart);
        }

        // Retourner la vue avec la liste des voyages filtrés
        return view('compagnie.voyage.index', compact('voyages', 'villes'));
    }

    public function show($id)
    {
        // Récupérer le voyage avec toutes les informations associées
        $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur','gare'])->findOrFail($id);
        $gare = gare::with('ville')->find($voyage->gare_id);    
        $bus = Bus::where('id',$voyage->bus_id)->first();
        $chaffeur = Chauffeur::where('id' ,$voyage->chauffeur_id)->first();
        // dd($voyage->bus->configurationPlace->placeconfigbussave);
        return view('compagnie.voyage.show', compact('voyage' ,'gare','bus','chaffeur'));

//     $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur','gare'])->findOrFail($id);
//     $gare = gare::with('ville')->find($voyage->gare_id);    
//     $bus = Bus::where('id',$voyage->bus_id)->first();
//     $chaffeur = Chauffeur::where('id' ,$voyage->chauffeur_id)->first();
// // dd($voyage->arretVoyages() , );
//     return view('compagnie.voyage.show', compact('voyage' ,'gare','bus','chaffeur'));
}




// public function store(Request $request)
// {
//     $user = Auth::user();

//     $validatedData = $request->validate([
//         'itineraire_id' => 'required',
//         'heure_depart' => 'required',
//         'date_depart' => 'required',
//         'bus_id' => 'required|exists:buses,id',
//         'chauffeur_id' => 'required|exists:chauffeurs,id',
//         'arrets.*.nom' => 'required|string|max:255',
//     ]);

//     dd($validatedData);

//     $infoUserId = $user->info_user->id ?? null;
//     $compagnieID = $user->info_user->gare->compagnie->id ?? $user->info_user->compagnie->id ?? null;
//     //dd($garesID , $compagnieID );
//     $garesID = $user->info_user->gare->id;
//     // dd($compagnieID);
//     // Création du voyage
//     $voyage = Voyage::create([
//         'info_user_id' => $infoUserId,
//         'itineraire_id' => $request->itineraire_id,
//         'heure_depart' => $validatedData['heure_depart'],
//         'date_depart' => $validatedData['date_depart'],
//         'bus_id' => $validatedData['bus_id'],
//         'chauffeur_id' => $validatedData['chauffeur_id'],
//         'compagnie_id' => $compagnieID ?? null,
//         'gare_id'=>$garesID ?? null,
//         'status'=>1,
//     ]);
//     // Redirection vers la liste des voyages avec un message de succès
//     return redirect()->route('voyage.index')->with('success', 'Le voyage a été créé avec succès.');
// }

public function store(Request $request)
{
    //dd($request->all());
    $user = Auth::user();
    //Validation principale
    $validatedData = $request->validate([
        'itineraire_id' => 'required|exists:itineraires,id',
        'heure_depart' => 'required',
        'date_depart' => 'nullable|date',
        'bus_id' => 'required|exists:buses,id',
        'chauffeur_id' => 'required|exists:chauffeurs,id',
        'montant'   => 'array',
        'montant.*' => 'numeric|min:0', // chaque montant est requis et >= 0
        'disponible_toujours' => 'nullable|boolean',
    ]);

    $infoUserId  = $user->info_user->id ?? null;
    $compagnieID = $user->info_user->gare->compagnie->id 
                ?? $user->info_user->compagnie->id 
                ?? null;

    // $garesID = $user->info_user->gare->id ?? null;
    $itineraire = Itineraire::where('id', $validatedData['itineraire_id'])->first();
    // dd($garesID,$itineraire);

    // Création du voyage
    $voyage = Voyage::create([
        'info_user_id' => $infoUserId,
        'itineraire_id' => $validatedData['itineraire_id'],
        'heure_depart' => $validatedData['heure_depart'],
        'date_depart' => $validatedData['date_depart'],
        'bus_id' => $validatedData['bus_id'],
        'chauffeur_id' => $validatedData['chauffeur_id'],
        'compagnie_id' => $compagnieID,
        //'gare_id'=> $garesID,
        'gare_id' => $itineraire->gare_id,
        'status'=> 1,
        //'disponible_toujours' => $validatedData['disponible_toujours'],
        'disponible_toujours' => $validatedData['disponible_toujours'] ?? false,
    ]);

    // Sauvegarde des montants pour chaque arrêt
    if (!empty($validatedData['montant'])) {
        $arretsData = [];
        foreach ($validatedData['montant'] as $arretId => $montant) {
            $arretsData[] = [
                'voyage_id' => $voyage->id,
                'arret_id' => $arretId,
                'montant'  => $montant,
            ];
        }
        // Débogage : voir toutes les données des arrêts avant insertion
        // dd($arretsData);
        // Insertion des arrêts liés au voyage
        // dd($arretsData , $voyage);
        foreach ($arretsData as $arret) {
            ArretVoyage::create($arret);
        }
    }

    return redirect()
        ->route('voyage.index')
        ->with('success', 'Le voyage a été créé avec succès.');
}




// public function details($id)
// {
//     // Récupère l'itinéraire avec ses relations
//     $itineraire = Itineraire::with(['ville', 'compagnie', 'gare', 'arrets'])->find($id);

//     if (!$itineraire) {
//         return response()->json(['error' => 'Itinéraire non trouvé'], 404);
//     }

//     return response()->json([
//         'id' => $itineraire->id,
//         'titre' => $itineraire->titre,
//         'estimation' => $itineraire->estimation,

//         // Ville liée
//         'ville' => $itineraire->ville ? [
//             'id' => $itineraire->ville->id,
//             'nom' => $itineraire->ville->nom_ville,
//         ] : null,

//         // Gare liée
//         'gare' => $itineraire->gare ? [
//             'id' => $itineraire->gare->id,
//             'nom' => $itineraire->gare->nom_gare,
//             'adresse' => $itineraire->gare->adresse_gare,
//             'telephone' => $itineraire->gare->telephone_gare,
//             'email' => $itineraire->gare->email,
//             'latitude' => $itineraire->gare->latitude,
//             'longitude' => $itineraire->gare->longitude,
//         ] : null,

//         // Arrêts associés
//         'arrets' => $itineraire->arrets->map(function($arret) {
//             return [
//                 'id' => $arret->id,
//                 'nom' => $arret->nom,
//                 'info_user_id' => $arret->info_user_id,
//                 'created_at' => $arret->created_at,
//                 'updated_at' => $arret->updated_at,
//             ];
//         }),
//     ]);
// }

public function details($id)
{
    $itineraire = Itineraire::with(['ville', 'gare', 'arrets.ville', 'arrets.gare'])->where('status',1)->find($id);

    if (!$itineraire) {
        return response()->json(['error' => 'Itinéraire non trouvé'], 404);
    }

    return response()->json([
        'id' => $itineraire->id,
        'titre' => $itineraire->titre,
        'estimation' => $itineraire->estimation,
        'ville_depart_gare' =>$itineraire->gare->ville->nom_ville,
        'nom_gare' =>$itineraire->gare->nom_gare,

        // Ville principale de l’itinéraire
        'ville' => $itineraire->ville ? [
            'id' => $itineraire->ville->id,
            'nom' => $itineraire->ville->nom_ville,
        ] : null,

        // Gare principale
        'gare' => $itineraire->gare ? [
            'id' => $itineraire->gare->id,
            'nom' => $itineraire->gare->nom_gare,
        ] : null,

  // Arrêts avec gare et ville
        'arrets' => $itineraire->arrets->map(function($arret){
            return [
                'id' => $arret->id,
                'nom' => $arret->nom,
                'gare' => $arret->gare ? [
                    'id' => $arret->gare->id,
                    'nom' => $arret->gare->nom_gare,
                    'ville' => $arret->gare->ville ? $arret->gare->ville->nom_ville : null,
                ] : null,
                'montant' => $arret->montant,
            ];
        }),

    ]);
}



// public function update(Request $request, $id)
// {
//     $user = Auth::user();

//     $validatedData = $request->validate([
//         'itineraire_id' => 'required',
//         'montant' => 'required|numeric|min:1',
//         'heure_depart' => 'required',
//         'date_depart' => 'required',
//         'bus_id' => 'required|exists:buses,id',
//         'chauffeur_id' => 'required|exists:chauffeurs,id',
//         'arrets.*.nom' => 'required|string|max:255',
//     ]);

//     $voyage = Voyage::findOrFail($id);

//     $infoUserId = $user->info_user->id ?? null;
//     $compagnieID  = $user->info_user->gare->compagnie->id ?? null;
//     $garesID = $user->info_user->gare->id ?? null;

//     // Mise à jour des données du voyage
//     $voyage->update([
//         'info_user_id' => $infoUserId,
//         'itineraire_id' => $request->itineraire_id,
//         'montant' => $validatedData['montant'],
//         'heure_depart' => $validatedData['heure_depart'],
//         'date_depart' => $validatedData['date_depart'],
//         'bus_id' => $validatedData['bus_id'],
//         'chauffeur_id' => $validatedData['chauffeur_id'],
//         'compagnie_id' => $compagnieID,
//         'gare_id' => $garesID,
//     ]);

//     // Mise à jour des arrêts
//     if (isset($request->arrets) && is_array($request->arrets)) {
//         // Supprimer les anciens arrêts
//         $voyage->arrets()->delete();

//         // Créer les nouveaux arrêts
//         foreach ($request->arrets as $arretData) {
//             $voyage->arrets()->create([
//                 'nom' => $arretData['nom'],
//                 'info_user_id' => $infoUserId,
//             ]);
//         }
//     }

//     return redirect()->route('voyage.index')->with('success', 'Le voyage a été mis à jour avec succès.');
// }

// public function update(Request $request, $id)
// {
//     $user = Auth::user();

//     // Validation des champs principaux et des montants
//     $validatedData = $request->validate([
//         'itineraire_id' => 'required|exists:itineraires,id',
//         'heure_depart' => 'required',
//         'date_depart' => 'required|date',
//         'bus_id' => 'required|exists:buses,id',
//         'chauffeur_id' => 'required|exists:chauffeurs,id',
//         'montant'   => 'array',
//         'montant.*' => 'numeric|min:0', // chaque montant >= 0
//     ]);

//     $voyage = Voyage::findOrFail($id);

//     $infoUserId  = $user->info_user->id ?? null;
//     $compagnieID = $user->info_user->gare->compagnie->id 
//                 ?? $user->info_user->compagnie->id 
//                 ?? null;
//     $garesID     = $user->info_user->gare->id ?? null;

//     // Mise à jour du voyage
//     $voyage->update([
//         'info_user_id'   => $infoUserId,
//         'itineraire_id'  => $validatedData['itineraire_id'],
//         'heure_depart'   => $validatedData['heure_depart'],
//         'date_depart'    => $validatedData['date_depart'],
//         'bus_id'         => $validatedData['bus_id'],
//         'chauffeur_id'   => $validatedData['chauffeur_id'],
//         'compagnie_id'   => $compagnieID,
//         'gare_id'        => $garesID,
//         'status'         => $voyage->status ?? 1,
//     ]);

//     // Suppression des anciens arrêts liés à ce voyage
//     ArretVoyage::where('voyage_id', $voyage->id)->delete();

//     // Sauvegarde des nouveaux montants pour chaque arrêt
//     if (!empty($validatedData['montant'])) {
//         $arretsData = [];
//         foreach ($validatedData['montant'] as $arretId => $montant) {
//             $arretsData[] = [
//                 'voyage_id' => $voyage->id,
//                 'arret_id'  => $arretId,
//                 'montant'   => $montant,
//             ];
//         }

//         // Insertion
//         foreach ($arretsData as $arret) {
//             ArretVoyage::create($arret);
//         }
//     }

//     return redirect()
//         ->route('voyage.index')
//         ->with('success', 'Le voyage a été mis à jour avec succès.');
// }


public function update(Request $request, $id)
{
    $user = Auth::user();

    // Validation
    $validatedData = $request->validate([
        'itineraire_id' => 'required|exists:itineraires,id',
        'heure_depart'  => 'required',
        'date_depart'   => 'nullable|date',
        'bus_id'        => 'required|exists:buses,id',
        'chauffeur_id'  => 'required|exists:chauffeurs,id',
        'montant'       => 'array',
        'montant.*'     => 'numeric|min:0',
        'disponible_toujours' => 'nullable|boolean',
    ]);

    $voyage = Voyage::findOrFail($id);

    $infoUserId  = $user->info_user->id ?? null;
    $compagnieID = $user->info_user->gare->compagnie->id 
                ?? $user->info_user->compagnie->id 
                ?? null;
    $garesID     = $user->info_user->gare->id ?? null;

    // Mise à jour du voyage
    $voyage->update([
        'info_user_id'  => $infoUserId,
        'itineraire_id' => $validatedData['itineraire_id'],
        'heure_depart'  => $validatedData['heure_depart'],
        'date_depart'   => $validatedData['date_depart'],
        'bus_id'        => $validatedData['bus_id'],
        'chauffeur_id'  => $validatedData['chauffeur_id'],
        'compagnie_id'  => $compagnieID,
        'gare_id'       => $garesID,
        'disponible_toujours' => $validatedData['disponible_toujours'] ?? false,
    ]);

    // Mise à jour des montants existants
    if (!empty($validatedData['montant'])) {
        foreach ($validatedData['montant'] as $arretId => $montant) {
            ArretVoyage::updateOrCreate(
                ['voyage_id' => $voyage->id, 'arret_id' => $arretId],
                ['montant' => $montant]
            );
        }
    }

    return redirect()
        ->route('voyage.index')
        ->with('success', 'Le voyage a été mis à jour avec succès.');
}


public function create()
{
    $user = Auth::user();
    $compagnieID  = $user->info_user->gare->compagnie->id 
                ?? $user->info_user->compagnie->id 
                ?? null;
    // Récupérer les itinéraires, buses, chauffeurs et villes (si nécessaire)
    if($user->info_user->gare){
        $itineraires = Itineraire::where('gare_id', $user->info_user->gare->id)->where('status', 1)->get();  // Récupère tous les itinéraires
        // dd('gare');
    }
    elseif($user->info_user->compagnie){
        $itineraires = Itineraire::where('compagnie_id', $compagnieID)->where('status', 1)->get();  // Récupère tous les itinéraires
        // dd('Compagnie');
    }

    // $itineraire_de_la_garel_ier = Itineraire::where('gare_id', $user->info_user->gare->id)->first();

    $buses = Bus::where('compagnies_id', $compagnieID)->where('status', 1)->get();               // Récupère tous les buses
    $chauffeurs = Chauffeur::where('compagnies_id', $compagnieID)->where('status', 1)->get();     // Récupère tous les chauffeurs
    // Passer ces données à la vue
    return view('compagnie.voyage.create', compact('itineraires', 'buses', 'chauffeurs'));
}


//    public function edit($id)
// {
//     // Récupérer les itinéraires, buses, chauffeurs et villes (si nécessaire)
//     $itineraires = Itineraire::all();  // Récupère tous les itinéraires
//     $buses = Bus::all();               // Récupère tous les buses
//     $chauffeurs = Chauffeur::all();     // Récupère tous les chauffeurs
//     $villes = Ville::all();             // Si tu as besoin de villes pour les arrêts
//     // Passer ces données à la vue
//     $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur'])->findOrFail($id);

//     return view('compagnie.voyage.edit', compact('itineraires', 'buses', 'chauffeurs', 'villes','voyage'));
// }

// public function edit($id)
// {
//     // Récupérer les itinéraires avec les arrêts et gares
//     $itineraires = Itineraire::with('arrets.gare.ville')->get(); 
//     $buses = Bus::all();
//     $chauffeurs = Chauffeur::all();
//     $villes = Ville::all();
//     // Récupérer le voyage
//     $voyage = Voyage::with(['itineraire.arrets.gare.ville', 'info_user', 'bus', 'chauffeur'])->findOrFail($id);
//     // Récupérer les montants liés au voyage pour chaque arrêt
//     $arretVoyages = ArretVoyage::where('voyage_id', $id)->get()->keyBy('arret_id'); 
//     // On crée un tableau associatif [arret_id => ArretVoyage]
//     return view('compagnie.voyage.edit', compact('itineraires', 'buses', 'chauffeurs', 'villes', 'voyage', 'arretVoyages'));
// }

public function edit($id)
{
    // $user = auth()->user();
    $user = Auth::user();
    // Récupérer les itinéraires selon le profil utilisateur
    if ($user->info_user->gare) {
        $itineraires = Itineraire::with('arrets.gare.ville')
            ->where('gare_id', $user->info_user->gare->id)
            ->where('status', 1)
            ->get();
    } 
    elseif ($user->info_user->compagnie) {
        $compagnieID = $user->info_user->compagnie->id;

        $itineraires = Itineraire::with('arrets.gare.ville')
            ->where('compagnie_id', $compagnieID)
            ->where('status', 1)
            ->get();
    } 
    else {
        // fallback sécurité
        $itineraires = collect();
    }

    // Autres données
    $buses = Bus::all();
    $chauffeurs = Chauffeur::all();
    $villes = Ville::all();

    // Voyage à modifier
    $voyage = Voyage::with([
        'itineraire.arrets.gare.ville',
        'info_user',
        'bus',
        'chauffeur'
    ])->findOrFail($id);

    // Montants par arrêt
    $arretVoyages = ArretVoyage::where('voyage_id', $id)
        ->get()
        ->keyBy('arret_id');

    return view(
        'compagnie.voyage.edit',
        compact('itineraires', 'buses', 'chauffeurs', 'villes', 'voyage', 'arretVoyages')
    );
}


public function destroy($id)
{
    $voyage = Voyage::findOrFail($id);
    $voyage->status = 3; // Supprimé / Inactif
    $voyage->save();

    return redirect()->back()->with('success', 'Personnel supprimé avec succès.');
}

public function destroy_reactivation($id)
{
    $voyage = Voyage::findOrFail($id);
    $voyage->status = 1; // Réactivation
    $voyage->save();

    return redirect()->back()->with('success', 'Personnel réactivé avec succès.');
}

}
