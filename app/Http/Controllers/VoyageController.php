<?php

namespace App\Http\Controllers;



use App\Models\ArretVoyage;
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
        $voyages = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur'])->get();
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
    $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur'])->findOrFail($id);

    return view('compagnie.voyage.show', compact('voyage'));
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




public function details($id)
{
    // Récupère l'itinéraire
    $itineraire = Itineraire::with(['ville', 'compagnie', 'gare', 'arrets'])->find($id);

    if (!$itineraire) {
        return response()->json(['error' => 'Itinéraire non trouvé'], 404);
    }

    return response()->json([
        'id' => $itineraire->id,
        // 'user_id' => $itineraire->user_id,
        // 'info_user_id' => $itineraire->info_user_id,
        'titre' => $itineraire->titre,
        'estimation' => $itineraire->estimation,
        // 'statut' => $itineraire->statut,
        // Infos liées
        'ville' => $itineraire->ville ? [
            'id' => $itineraire->ville->id,
            'nom' => $itineraire->ville->nom_ville, // adapte selon tes colonnes
        ] : null,
        // 'compagnie' => $itineraire->compagnie ? [
        //     'id' => $itineraire->compagnie->id,
        //     'nom' => $itineraire->compagnie->nom,
        // ] : null,
        // 'gare' => $itineraire->gare ? [
        //     'id' => $itineraire->gare->id,
        //     'nom' => $itineraire->gare->nom,
        // ] : null,
        // Arrets associés
        'arrets' => $itineraire->arrets->map(function($arret){
            return [
                'id' => $arret->id,
                'nom' => $arret->nom,
                'info_user_id' => $arret->info_user_id,
                'created_at' => $arret->created_at,
                'updated_at' => $arret->updated_at,
            ];
        }),
    ]);
}



public function update(Request $request, $id)
{
    $user = Auth::user();

    $validatedData = $request->validate([
        'itineraire_id' => 'required',
        'montant' => 'required|numeric|min:1',
        'heure_depart' => 'required',
        'date_depart' => 'required',
        'bus_id' => 'required|exists:buses,id',
        'chauffeur_id' => 'required|exists:chauffeurs,id',
        'arrets.*.nom' => 'required|string|max:255',
    ]);

    $voyage = Voyage::findOrFail($id);

    $infoUserId = $user->info_user->id ?? null;
    $compagnieID  = $user->info_user->gare->compagnie->id ?? null;
    $garesID = $user->info_user->gare->id ?? null;

    // Mise à jour des données du voyage
    $voyage->update([
        'info_user_id' => $infoUserId,
        'itineraire_id' => $request->itineraire_id,
        'montant' => $validatedData['montant'],
        'heure_depart' => $validatedData['heure_depart'],
        'date_depart' => $validatedData['date_depart'],
        'bus_id' => $validatedData['bus_id'],
        'chauffeur_id' => $validatedData['chauffeur_id'],
        'compagnie_id' => $compagnieID,
        'gare_id' => $garesID,
    ]);

    // Mise à jour des arrêts
    if (isset($request->arrets) && is_array($request->arrets)) {
        // Supprimer les anciens arrêts
        $voyage->arrets()->delete();

        // Créer les nouveaux arrêts
        foreach ($request->arrets as $arretData) {
            $voyage->arrets()->create([
                'nom' => $arretData['nom'],
                'info_user_id' => $infoUserId,
            ]);
        }
    }

    return redirect()->route('voyage.index')->with('success', 'Le voyage a été mis à jour avec succès.');
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

   public function edit($id)
{
    // Récupérer les itinéraires, buses, chauffeurs et villes (si nécessaire)
    $itineraires = Itineraire::all();  // Récupère tous les itinéraires
    $buses = Bus::all();               // Récupère tous les buses
    $chauffeurs = Chauffeur::all();     // Récupère tous les chauffeurs
    $villes = Ville::all();             // Si tu as besoin de villes pour les arrêts
    // Passer ces données à la vue
    $voyage = Voyage::with(['itineraire', 'info_user', 'bus', 'chauffeur'])->findOrFail($id);

    return view('compagnie.voyage.edit', compact('itineraires', 'buses', 'chauffeurs', 'villes','voyage'));
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
