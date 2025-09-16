<?php

namespace App\Http\Controllers;



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

    return view('compagnie.voyage.details', compact('voyage'));
}




public function store(Request $request)
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

    $infoUserId = $user->info_user->id ?? null;
    $compagnieID  = $user->info_user->gare->compagnie->id;
    $garesID = $user->info_user->gare->id;
    // dd($compagnieID);
    // Création du voyage
    $voyage = Voyage::create([
        'info_user_id' => $infoUserId,
        'itineraire_id' => $request->itineraire_id,
        'montant' => $validatedData['montant'],
        'heure_depart' => $validatedData['heure_depart'],
        'date_depart' => $validatedData['date_depart'],
        'bus_id' => $validatedData['bus_id'],
        'chauffeur_id' => $validatedData['chauffeur_id'],
        'compagnie_id' => $compagnieID,
        'gare_id'=>$garesID ?? null,
    ]);

    // // Vérifier si 'arrets' existe et est un tableau avant de boucler dessus
    // if (isset($request->arrets) && is_array($request->arrets)) {
    //     foreach ($request->arrets as $arretData) {
    //         Arret::create([
    //             'nom' => $arretData['nom'],
    //             'voyage_id' => $voyage->id,
    //         ]);
    //     }
    // } else {
    //     // Si 'arrets' est vide ou non fourni, gérer cela comme un cas spécial ou afficher un message d'erreur
    //     // Par exemple :
    //     return redirect()->route('voyage.index')->with('error', 'Aucun arrêt fourni pour le voyage.');
    // }

    // Redirection vers la liste des voyages avec un message de succès
    return redirect()->route('voyage.index')->with('success', 'Le voyage a été créé avec succès.');
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
}
