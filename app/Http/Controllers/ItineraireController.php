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
    // ID de l'utilisateur connecté
    $userId = Auth::id();

    // Récupération de la ville de départ via la gare de l'utilisateur
    $gare = \App\Models\Gare::join('info_users', 'gares.info_user_id', '=', 'info_users.id')
                ->where('info_users.user_id', $userId)
                ->select('gares.ville_id')
                ->first();

    $villeId = $gare->ville_id ?? null;

    // Pour afficher toutes les villes si besoin dans un select
    $villes = \App\Models\Ville::orderBy('nom_ville')->get();

    return view("compagnie.itineraire.create", compact("villes", "villeId"));
}


    public function store(Request $request)
    {
        $user = Auth::user();

        // Validation
        $validated = $request->validate([

            'estimation'       => 'nullable',
            'titre'       => 'nullable',
            'arrets'         => 'nullable|array',
            'arrets.*.nom'   => 'required_with:arrets|string|max:255',
        ]);

        // Récupération de info_user_id
        $infoUserId = $user->info_user->id ?? null;

        if (!$infoUserId) {
            return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
        }

        // Création du voyage
        // Création du voyage
        $voyage = itineraire::create([
            'user_id'      => $user->id,
            'info_user_id' => $infoUserId,
            'ville_id'      => $request->ville_id,
            'estimation'   => $request->estimation,
            'titre'        => $request->titre,
            'statut'       => 1,
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
