<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use App\Models\User;
use App\Models\InfoUser;
use App\Models\Compagnies;
use Illuminate\Support\Facades\Validator;
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
        $info_user = InfoUser::where('id', $compagnie->info_user_id)->first();
        $user_utilisateur = User::where('id', $info_user->user_id)->first();

        return view('register-pending', compact('compagnie','user_utilisateur'));
    }

      public function store(Request $request)
{
    // try {
        // $validated = $request->validate([
            $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            // 'email' => ['required', 'email','unique:users,email'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            // 'password' => 'required|confirmed',
            'nom_complet_compagnies' => 'required|unique:compagnies,nom_complet_compagnies',
            'email_compagnies' => 'nullable|email|unique:compagnies,email_compagnies',
            'telephone_compagnies' => 'required',
            'adresse_compagnies' => 'nullable|string',
            'description_compagnies' => 'nullable|string',
            'logo_compagnies' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'adresse' => 'nullable|string',
            'villes_id' => 'required|exists:villes,id',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'email.required' => 'L\'email de l\'administrateur est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'confirmed' => 'Les mots de passe ne correspondent pas.',
            'email.unique' => 'L\'email de l\'administrateur est deja utilisé.',
            'email.required' => 'L\'email de l\'administrateur est obligatoire.',
            'mimes' => 'Le format du fichier est incorrect.',
            'max' => 'Le format du fichier doit être , jpg, jpeg, png ou gif doit pas dépasser 10 Mo .',
            'exists' => 'La ville sélectionnée est invalide.',
            'nom_complet_compagnies.unique' => 'Le nom de la compagnie est deja utilisé.',
            'nom_complet_compagnies.required' => 'Le nom de la compagnie est obligatoire.',
            'email_compagnies.unique' => 'L\'email de la compagnie est deja utilisé.',
            'villes_id.exists' => 'La ville sélectionnée est n\'existe pas.',
            'villes_id.required' => 'La ville est obligatoire.',
        ]);

          if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput()
            ->withFragment('inscription-section');
    }

        $validatedData = $validator->validated();


        // Création de l'utilisateur
        $user = User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            // 'password' => Hash::make($validator['password']),
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
            'nom_complet_compagnies' => $validatedData['nom_complet_compagnies'],
            'email_compagnies' => $validatedData['email_compagnies'],
            'telephone_compagnies' => $validatedData['telephone_compagnies'],
            'adresse_compagnies' => $validatedData['adresse_compagnies'],
            'description_compagnies' => $validatedData['description_compagnies'],
            'logo_compagnies' => $logoPath,
            'info_user_id' => $infoUser->id,
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'adresse' => $validatedData['adresse'] ?? null,  
            'villes_id' => $validatedData['villes_id'],
            'status' => 2,
        ]);

        return redirect()->route('register.pending', ['id' => $compagnies->id])->withFragment('inscription-section')->with('success', 'Votre demande a bien été envoyée.');

    // } catch (\Exception $e) {
    //     return redirect()->back()->with('error',  $e->getMessage())->withFragment('inscription-section');;
    // }
}



}
