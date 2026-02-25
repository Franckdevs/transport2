<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Compagnies;
class ParamettreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    return view('compagnie.profil.paramettre');
    }

        public function updateInfos(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only(['nom', 'prenom', 'telephone', 'email']));

        return back()->with('success', 'Informations mises à jour avec succès.');
    }

public function updatePassword(Request $request)
{
    $user = Auth::user();
    $request->validate([
        'new_password' => 'required|min:6',
    ]);
    $user->update([
        'password' => Hash::make($request->new_password),
    ]);
    return back()->with('success', 'Mot de passe modifié avec succès.');
}

/**
 * Met à jour le logo de la compagnie
 */
// Dans ParamettreController.php

public function updateLogo(Request $request)
{
    $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:25600',
    ]);

    $user = Auth::user();
    $compagnie = $user->info_user->compagnie;
    
    if (!$compagnie) {
        return response()->json([
            'success' => false,
            'message' => 'Aucune compagnie associée à cet utilisateur'
        ], 404);
    }

    // Supprimer l'ancien logo s'il existe
    if ($compagnie->logo_compagnies && file_exists(public_path($compagnie->logo_compagnies))) {
        unlink(public_path($compagnie->logo_compagnies));
    }

    // Créer le dossier s'il n'existe pas
    $logoPath = 'logo_compagnie';
    if (!file_exists(public_path($logoPath))) {
        mkdir(public_path($logoPath), 0777, true);
    }

    // Enregistrer le nouveau logo
    $logoName = 'logo_' . $compagnie->id . '_' . time() . '.' . $request->logo->extension();
    $request->logo->move(public_path($logoPath), $logoName);
    
    // Mettre à jour le chemin du logo dans la base de données
    $compagnie->logo_compagnies = $logoName;
    $compagnie->save();

    return back()->with('success', 'Logo mis à jour avec succès.');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
