<?php

namespace App\Http\Controllers;

use App\Models\Arret;
use App\Models\Ville;
use App\Models\itineraire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItineraireController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté

        $voyages = itineraire::where('info_user_id', $user->info_user->id)
            ->where('statut', 1)
            ->get();

        return view("compagnie.itineraire.index", compact("voyages"));
    }
    public function create()
    {
        $villes = Ville::orderBy('nom_ville')->get();

        return view("compagnie.itineraire.create", compact("villes"));
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validation
        $validated = $request->validate([
            'vdepart'        => 'required|string|max:255',
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
            'vdepart'      => $request->vdepart,
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
