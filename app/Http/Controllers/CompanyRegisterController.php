<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\User;
use App\Models\InfoUser;
use App\Models\Compagnies;

class CompanyRegisterController extends Controller
{
    public function show()
    {
        $villes = Ville::all();
        return view('register', compact('villes'));
    }

    public function pending($id = null)
    {
        if (!$id) {
            return redirect('/');
        }

        $compagnie = Compagnies::find($id);
        if (!$compagnie) {
            return redirect('/');
        }

        return view('register-pending', compact('compagnie'));
    }

      public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            // 'password' => 'required|confirmed',
            'nom_complet_compagnies' => 'required',
            'email_compagnies' => 'required',
            'telephone_compagnies' => 'required',
            'adresse_compagnies' => 'required',
            'description_compagnies' => 'nullable|string',
            'logo_compagnies' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'adresse' => 'nullable|string',
            'villes_id' => 'required|exists:villes,id',
        ], [
            'required' => 'Ce champ est obligatoire.',
            'confirmed' => 'Les mots de passe ne correspondent pas.',
            'unique' => 'Le email de l\'administrateur ou de la compagnie est deja utilisé.',
            'mimes' => 'Le format du fichier est incorrect.',
            'max' => 'Le fichier doit avoir une taille maximale de 2Mo.',
            'email' => 'Le format de l\'email est incorrect.',
            'exists' => 'La ville sélectionnée est invalide.',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            // 'password' => Hash::make($validated['password']),
        ]);

        $infoUser = InfoUser::create([
            'user_id' => $user->id,
            'nom' => $user->nom,
            'prenom' => $user->prenom,
            'telephone' => $user->telephone,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $user->assignRole('super-admin-compagnie');
        // Ajouter la permission "tout-les-permissions" directement
        $user->givePermissionTo('tout-les-permissions');
        // $permission = Permission::firstOrCreate(['name' => 'tout-les-permissions']);
        // $user->givePermissionTo($permission);
        // $logoPath = null;
        // if ($request->hasFile('logo_compagnies')) {
        //     $logoPath = $request->file('logo_compagnies')->store('logos', 'public');
        // }
        $logoPath = null;

    if ($request->hasFile('logo_compagnies')) {
        $folder = public_path('logo_compagnie'); // dossier à la racine du dossier public

        // Crée le dossier s'il n'existe pas
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Récupère le fichier
        $file = $request->file('logo_compagnies');

        // Génère un nom unique pour éviter les conflits
        $filename = time() . '_' . $file->getClientOriginalName();

        // Déplace le fichier dans le dossier
        $file->move($folder, $filename);

        // Chemin relatif pour sauvegarder en base ou afficher
        $logoPath =$filename;
    }

       $compagnies = Compagnies::create([
            'nom_complet_compagnies' => $validated['nom_complet_compagnies'],
            'email_compagnies' => $validated['email_compagnies'],
            'telephone_compagnies' => $validated['telephone_compagnies'],
            'adresse_compagnies' => $validated['adresse_compagnies'],
            'description_compagnies' => $validated['description_compagnies'],
            'logo_compagnies' => $logoPath,
            'info_user_id' => $infoUser->id,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'adresse' => $validated['adresse'] ?? null,  // 🔑 protection ajoutée
            'villes_id' => $validated['villes_id'],
            'status' => 2,
        ]);

        return redirect()->route('register.pending', ['id' => $compagnies->id])->with('success', 'Administrateur et compagnie créés avec succès.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error',  $e->getMessage());
    }
}



}
