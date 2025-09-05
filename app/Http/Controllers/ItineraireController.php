<?php

namespace App\Http\Controllers;

use App\Models\Arret;
use App\Models\gare;
use App\Models\ville;

use App\Models\itineraire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItineraireController extends Controller
{
public function index()
{
    $user = Auth::user(); // Récupère l'utilisateur connecté

    // Récupérer tous les voyages de l'utilisateur
    $voyages = Itineraire::where('user_id', $user->id)
                 ->with('arrets') // si tu veux récupérer les arrêts associés
                 ->get();

    return view("compagnie.itineraire.index", compact('voyages'));
}

public function create()
{
    $userId = Auth::id();
    // Récupération de la ville de départ via la gare de l'utilisateur
    $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
                ->where('info_users.user_id', $userId)
                ->select('gares.ville_id')
                ->first();
    $villeId = $gare->ville_id ?? null;
    // Pour afficher toutes les villes si besoin dans un select
    $villes = \App\Models\Ville::orderBy('nom_ville')->get();
    // Pour afficher toutes les gares si besoin dans un select
    $gars = null;
    
    if ($villeId == null) {
        $compagnie = \App\Models\Compagnies::where('info_user_id', $userId)->first();
        $gars = gare::where('compagnie_id', $compagnie->id)->get();
    }
    return view("compagnie.itineraire.create", compact("villes", "villeId" , "gars"));
}


    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        // Validation
    $validated = $request->validate([
    'ville_id'     => 'nullable|exists:villes,id',
    'estimation'   => 'nullable',
    'titre'        => 'nullable|string|max:255',
    'arrets'       => 'nullable|array',
    'arrets.*.nom' => 'required_with:arrets|string|max:255',
    ], [
        'ville_id.exists'     => 'La ville sélectionnée est invalide.',
        'titre.max'           => 'Le titre ne doit pas dépasser 255 caractères.',
        'arrets.*.nom.required_with' => 'Le nom de chaque arrêt est obligatoire lorsque des arrêts sont ajoutés.',
        'arrets.*.nom.string'        => 'Le nom de chaque arrêt doit être une chaîne de caractères.',
    ]);
        if ($validated['ville_id'] === null) {
            return back()->withErrors(['Erreur : La ville de départ est obligatoire.'])->withInput();
        }

        // Récupération de info_user_id
        $infoUserId = $user->info_user->id ?? null;

        if (!$infoUserId) {
            return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
        }
        // Création du voyage
        $voyage = itineraire::create([
            'user_id'      => $user->id,
            'info_user_id' => $infoUserId,
            'ville_id'      => $request->ville_id,
            'estimation'   => $request->estimation,
            'titre'        => $request->titre,
            'status'       => 1,
            'compagnie_id' => $user->info_user?->gare?->compagnie?->id
                  ?? $user->info_user?->compagnie?->id
                  ?? 0, // valeur par défaut si tout est null
            'gare_id'      => $user->info_user->gare->id ?? null,
        ]);

        // Vérifier si le voyage a bien été créé
        if (!$voyage || !$voyage->id) {
            return back()->withErrors(['Erreur : Le voyage n\'a pas été créé correctement.']);
        }

        // Création des arrêts
        if ($request->has('arrets')) {
            foreach ($request->arrets as $arretData) {
                Arret::create([
                    'itineraire_id' => $voyage->id,  // Utilise l'ID du voyage créé
                    'info_user_id'  => $infoUserId,
                    'nom'           => $arretData['nom'],
                ]);
            }
        }
        return redirect()->route('itineraire.index')->with('success', 'Voyage enregistré avec succès.');
    }


    public function show($id)
    {
        $voyage = itineraire::with('arrets')->findOrFail($id);
        return view('compagnie.itineraire.detail', compact('voyage'));
    }

}
