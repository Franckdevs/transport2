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
// use Illuminate\Support\Facades\Auth;


class VoyageController extends Controller
{

   public function index()
    {
        // Récupérer tous les voyages avec leurs relations
        $voyages = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur','arretVoyages'])->get();
           foreach ($voyages as $voyage) {
        $voyage->heure_depart = \Carbon\Carbon::parse($voyage->heure_depart);
        $voyage->date_depart = \Carbon\Carbon::parse($voyage->date_depart);
    }
        // Retourner la vue avec la liste des voyages
        return view('compagnie.voyage.index', compact('voyages'));
    }

public function show($id)
{
    // Récupérer le voyage avec toutes les informations associées
    $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur','gare'])->findOrFail($id);
    $gare = gare::with('ville')->find($voyage->gare_id);    
    $bus = Bus::where('id',$voyage->bus_id)->first();
    $chaffeur = Chauffeur::where('id' ,$voyage->chauffeur_id)->first();

    return view('compagnie.voyage.show', compact('voyage' ,'gare','bus','chaffeur'));
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
    $user = Auth::user();

    // Validation principale
    $validatedData = $request->validate([
        'itineraire_id' => 'required|exists:itineraires,id',
        'heure_depart' => 'required',
        'date_depart' => 'required|date',
        'bus_id' => 'required|exists:buses,id',
        'chauffeur_id' => 'required|exists:chauffeurs,id',
        'montant'   => 'array',
        'montant.*' => 'numeric|min:0', // chaque montant est requis et >= 0
    ]);

    $infoUserId  = $user->info_user->id ?? null;
    $compagnieID = $user->info_user->gare->compagnie->id 
                ?? $user->info_user->compagnie->id 
                ?? null;
    $garesID     = $user->info_user->gare->id ?? null;

    // Création du voyage
    $voyage = Voyage::create([
        'info_user_id' => $infoUserId,
        'itineraire_id' => $validatedData['itineraire_id'],
        'heure_depart' => $validatedData['heure_depart'],
        'date_depart' => $validatedData['date_depart'],
        'bus_id' => $validatedData['bus_id'],
        'chauffeur_id' => $validatedData['chauffeur_id'],
        'compagnie_id' => $compagnieID,
        'gare_id'=> $garesID,
        'status'=> 1,
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
    $itineraire = Itineraire::with(['ville', 'gare', 'arrets.ville', 'arrets.gare'])->find($id);

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
        'date_depart'   => 'required|date',
        'bus_id'        => 'required|exists:buses,id',
        'chauffeur_id'  => 'required|exists:chauffeurs,id',
        'montant'       => 'array',
        'montant.*'     => 'numeric|min:0',
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
    // Récupérer les itinéraires, buses, chauffeurs et villes (si nécessaire)
    $itineraires = Itineraire::all();  // Récupère tous les itinéraires
    $buses = Bus::all();               // Récupère tous les buses
    $chauffeurs = Chauffeur::all();     // Récupère tous les chauffeurs
    $villes = Ville::all();             // Si tu as besoin de villes pour les arrêts
    // Passer ces données à la vue
    return view('compagnie.voyage.create', compact('itineraires', 'buses', 'chauffeurs', 'villes'));
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

public function edit($id)
{
    // Récupérer les itinéraires avec les arrêts et gares
    $itineraires = Itineraire::with('arrets.gare.ville')->get(); 
    $buses = Bus::all();
    $chauffeurs = Chauffeur::all();
    $villes = Ville::all();
    // Récupérer le voyage
    $voyage = Voyage::with(['itineraire.arrets.gare.ville', 'info_user', 'bus', 'chauffeur'])->findOrFail($id);
    // Récupérer les montants liés au voyage pour chaque arrêt
    $arretVoyages = ArretVoyage::where('voyage_id', $id)->get()->keyBy('arret_id'); 
    // On crée un tableau associatif [arret_id => ArretVoyage]
    return view('compagnie.voyage.edit', compact('itineraires', 'buses', 'chauffeurs', 'villes', 'voyage', 'arretVoyages'));
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
