<?php

namespace App\Http\Controllers;

use App\Models\Arret;
use App\Models\gare;
use App\Models\ville;

use App\Models\itineraire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArretVoyage;
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




    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        // Validation
    $validated = $request->validate([
    // 'ville_id'     => 'nullable|exists:villes,id',
    'ville_id' => $request->has('gare_id') ? 'required|exists:villes,id' : 'nullable|exists:villes,id',
    'estimation'   => 'nullable',
    'titre'        => 'nullable|string|max:255',
    'gare_id'      => 'nullable|exists:gares,id',
    'gares'      => 'nullable|array',
    // 'gares.*.id' => 'required_with:gares|exists:gares,id',
        'gares.*.id' => 'required|exists:gares,id'

    // 'arrets'       => 'nullable|array',
    // 'arrets.*.nom' => 'required_with:arrets|string|max:255',
    ], [
        'ville_id.exists'     => 'La ville sélectionnée est invalide.',
        'titre.max'           => 'Le titre ne doit pas dépasser 255 caractères.',
        // 'arrets.*.nom.required_with' => 'Le nom de chaque arrêt est obligatoire lorsque des arrêts sont ajoutés.',
        // 'arrets.*.nom.string'        => 'Le nom de chaque arrêt doit être une chaîne de caractères.',

    ]);

    // dd($validated);
        
        // if ($validated['ville_id'] === null) {
        //     return back()->withErrors(['Erreur : La ville de départ est obligatoire.'])->withInput();
        // }


        if (empty($validated['ville_id']) && empty($validated['gare_id'])) {
    return back()->withErrors(['Erreur : La ville de départ ou la gare de départ est obligatoire.'])->withInput();
}

// Si ville_id n'est pas défini mais gare_id l'est, récupérez la ville de la gare
if (empty($validated['ville_id']) && !empty($validated['gare_id'])) {
    $gare = Gare::find($validated['gare_id']);
    if ($gare) {
        $validated['ville_id'] = $gare->ville_id;
    }
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
            // 'gare_id'      => $user->info_user->gare->id ?? null,
            'gare_id' => $validated['gare_id'] ?? $user->info_user->gare->id ?? null,
        ]);

        // Vérifier si le voyage a bien été créé
        if (!$voyage || !$voyage->id) {
            return back()->withErrors(['Erreur : Le voyage n\'a pas été créé correctement.']);
        }

        // Création des arrêts
        // if ($request->has('arrets')) {
        //     foreach ($request->arrets as $arretData) {
        //         Arret::create([
        //             'itineraire_id' => $voyage->id,  // Utilise l'ID du voyage créé
        //             'info_user_id'  => $infoUserId,
        //             'nom'           => $arretData['nom'],
        //         ]);
        //     }
        // }

           // Création des gares (remplace les arrêts)
    if ($request->has('gares')) {
        foreach ($request->gares as $gareData) {
            Arret::create([
                'itineraire_id' => $voyage->id,
                'info_user_id'  => $infoUserId,
                'gares_id'      => $gareData['id'], // clé étrangère vers la gare
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
        'gare_id'     => 'required|exists:gares,id',
        'estimation'  => 'nullable',
        'titre'       => 'nullable|string|max:255',
        'gares'       => 'required|array|min:1',
        'gares.*.id'  => 'required|exists:gares,id',
    ], [
        'gare_id.required' => 'La gare de départ est obligatoire.',
        'gare_id.exists'   => 'La gare sélectionnée est invalide.',
        'titre.max'        => 'Le titre ne doit pas dépasser 255 caractères.',
        'gares.required'   => 'Veuillez ajouter au moins une gare d\'arrêt.',
        'gares.min'        => 'Veuillez ajouter au moins une gare d\'arrêt.',
    ]);

    dd($validated);
    // Récupération de info_user_id
    $infoUserId = $user->info_user->id ?? null;
    if (!$infoUserId) {
        return back()->withErrors(['Erreur : info_user_id manquant pour l\'utilisateur.']);
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

    // Supprimer tous les arrêts existants
    $voyage->arrets()->delete();

    // Créer les nouveaux arrêts
    if (isset($validated['gares'])) {
        foreach ($validated['gares'] as $gareData) {
            // Ne pas créer d'arrêt si c'est la gare de départ
            if ($gareData['id'] != $gare->id) {
                Arret::create([
                    'itineraire_id' => $voyage->id,
                    'info_user_id'  => $infoUserId,
                    'gares_id'      => $gareData['id'],
                ]);
            }
        }
    }
    
    return redirect()->route('itineraire.index')->with('success', 'Itinéraire mis à jour avec succès.');
}


    public function show($id)
    {
        $voyage = itineraire::with('arrets')->findOrFail($id);
        return view('compagnie.itineraire.detail', compact('voyage'));
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
                ->select('gares.ville_id')
                ->first();
                
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

    return view("compagnie.itineraire.edit", compact("villes", "villeId", "gars", "itineraire" ,"gares"));
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
