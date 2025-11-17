<?php

namespace App\Http\Controllers;

use App\Models\Compagnies;

use App\Models\InfoUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\CompagnieApprovedMail;
use App\Mail\CompagnieCreeeMail;
use App\Mail\CompagnieRefusedMail;
use App\Models\Ville;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Spatie\Permission\Models\Permission;

class CompagniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// public function index()
// {
// $compagnies = Compagnies::
// // ('status', 1)
//     orderBy('id', 'desc')
//     ->get();
//     return view('betro.compagnie.index', compact('compagnies'));
// }
public function index(Request $request)
{
    $query = Compagnies::orderBy('id', 'desc');

    // Filtrage par date si fourni
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $compagnies = $query->get();

    return view('betro.compagnie.index', compact('compagnies'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $villes = Ville::all();
     return view('betro.compagnie.create' , compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'unique' => 'Cet email est déjà utilisé.',
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
        ]);

        Mail::to($validated['email_compagnies'])->send(new CompagnieCreeeMail($infoUser , $compagnies));
        // return redirect()->back()->with('success', 'Administrateur et compagnie créés avec succès.');
        return redirect()->route('compagnies')->with('success', 'Administrateur et compagnie créés avec succès.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error',  $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Compagnies $compagnies)
    {
        //
        $users = InfoUser::where('id', $compagnies->info_user_id)->first();

        // dd($users);
        return view('betro.compagnie.show', compact('compagnies' , 'users'));
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compagnies $compagnies)
    {
        //
        $users = InfoUser::where('id', $compagnies->info_user_id)->first();
        // dd($users);
            $villes = Ville::all();
        return view('betro.compagnie.edit', compact('compagnies' , 'users' ,'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update($compagnies, Request $request)
    // {
    //     $compagnies = Compagnies::where('id', $compagnies)->first();
    //     $info_users = InfoUser::where('id', $compagnies->info_user_id)->first();
    //     $users = User::where('id', $info_users->user_id)->first();

    //     $emailRules = ['required', 'email'];
    // if ($request->email !== $users->email) {
    //     // Email a changé, on applique la règle unique
    //     $emailRules[] = 'unique:users,email';
    // }

    //      $validated = $request->validate([
    //         'nom' => 'required',
    //         'prenom' => 'required',
    //         'telephone' => 'required',
    //         'email' => $emailRules,
    //         // 'password' => 'required|confirmed',
    //         'nom_complet_compagnies' => 'required',
    //         'email_compagnies' => 'required',
    //         'telephone_compagnies' => 'required',
    //         'adresse_compagnies' => 'required',
    //         'description_compagnies' => 'nullable|string',
    //         'logo_compagnies' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    //         'villes_id' => 'required|exists:villes,id',
    //     ], [
    //         'required' => 'Ce champ est obligatoire.',
    //         'confirmed' => 'Les mots de passe ne correspondent pas.',
    //         'unique' => 'Cet email est déjà utilisé.',
    //         'mimes' => 'Le format du fichier est incorrect.',
    //         'max' => 'Le fichier doit avoir une taille maximale de 2Mo.',
    //     ]);


    //         $users->nom = $validated['nom'];
    //         $users->prenom = $validated['prenom'];
    //         $users->telephone = $validated['telephone'];
    //         $users->email = $validated['email'];
    //         // $users->password = Hash::make($validated['password']);
    //         $users->update();

    //         $info_users->nom = $validated['nom'];
    //         $info_users->prenom = $validated['prenom'];
    //         $info_users->telephone = $validated['telephone'];
    //         $info_users->email = $validated['email'];
    //         // $info_users->password = Hash::make($validated['password']);
    //         $info_users->update();

    //         $compagnies->nom_complet_compagnies = $validated['nom_complet_compagnies'];
    //         $compagnies->email_compagnies = $validated['email_compagnies'];
    //         $compagnies->telephone_compagnies = $validated['telephone_compagnies'];
    //         $compagnies->adresse_compagnies = $validated['adresse_compagnies'];
    //         $compagnies->description_compagnies = $validated['description_compagnies'];
    //         $compagnies->villes_id = $validated['villes_id'];

    //               $logoPath = null;

    //     if ($request->hasFile('logo_compagnies')) {
    //         $folder = public_path('logo_compagnie'); // dossier à la racine du dossier public

    //         // Crée le dossier s'il n'existe pas
    //         if (!file_exists($folder)) {
    //             mkdir($folder, 0755, true);
    //         }

    //         // Récupère le fichier
    //         $file = $request->file('logo_compagnies');

    //         // Génère un nom unique pour éviter les conflits
    //         $filename = time() . '_' . $file->getClientOriginalName();

    //         // Déplace le fichier dans le dossier
    //         $file->move($folder, $filename);

    //         // Chemin relatif pour sauvegarder en base ou afficher
    //         $logoPath =$filename;
    //     }

    //     $compagnies->logo_compagnies = $logoPath;
    //     $compagnies->update();

    //     return redirect()->route('compagnies')->with('success', 'Compagnie modifiée avec succès.');
    // }


    public function update($compagnies, Request $request)
{
    $compagnies = Compagnies::where('id', $compagnies)->first();
    $info_users = InfoUser::where('id', $compagnies->info_user_id)->first();
    $users = User::where('id', $info_users->user_id)->first();

    // Règles de validation
    $emailRules = ['required', 'email'];
    if ($request->email !== $users->email) {
        $emailRules[] = 'unique:users,email';
    }

    $validated = $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'telephone' => 'required',
        'email' => $emailRules,
        'nom_complet_compagnies' => 'required',
        'email_compagnies' => 'required|email',
        'telephone_compagnies' => 'required',
        'adresse_compagnies' => 'required',
        'description_compagnies' => 'nullable|string',
        'logo_compagnies' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'villes_id' => 'required|exists:villes,id',
    ], [
        'required' => 'Ce champ est obligatoire.',
        'email' => 'Veuillez entrer une adresse email valide.',
        'confirmed' => 'Les mots de passe ne correspondent pas.',
        'unique' => 'Cet email est déjà utilisé.',
        'mimes' => 'Le format du fichier est incorrect.',
        'max' => 'Le fichier doit avoir une taille maximale de 2Mo.',
    ]);

    // Mise à jour de l'utilisateur
    $users->nom = $validated['nom'] ?? $users->nom;
    $users->prenom = $validated['prenom'] ?? $users->prenom;
    $users->telephone = $validated['telephone'] ?? $users->telephone;
    $users->email = $validated['email'] ?? $users->email;

    // Mise à jour du code pays si fourni
    if (isset($validated['country_code'])) {
        $users->country_code = $validated['country_code'];
    }

    $users->save();

    // Mise à jour des infos utilisateur
    $info_users->nom = $validated['nom'] ?? $info_users->nom;
    $info_users->prenom = $validated['prenom'] ?? $info_users->prenom;
    $info_users->telephone = $validated['telephone'] ?? $info_users->telephone;
    $info_users->email = $validated['email'] ?? $info_users->email;

    // Mise à jour du code pays si fourni
    if (isset($validated['country_code'])) {
        $info_users->country_code = $validated['country_code'];
    }

    $info_users->save();

    // Mise à jour des informations de la compagnie
    $compagnies->nom_complet_compagnies = $validated['nom_complet_compagnies'] ?? $compagnies->nom_complet_compagnies;
    $compagnies->email_compagnies = $validated['email_compagnies'] ?? $compagnies->email_compagnies;
    $compagnies->telephone_compagnies = $validated['telephone_compagnies'] ?? $compagnies->telephone_compagnies;
    $compagnies->adresse_compagnies = $validated['adresse_compagnies'] ?? $compagnies->adresse_compagnies;
    $compagnies->description_compagnies = $validated['description_compagnies'] ?? $compagnies->description_compagnies;
    $compagnies->villes_id = $validated['villes_id'] ?? $compagnies->villes_id;

    // Mise à jour du code pays de la compagnie si fourni
    if (isset($validated['country_code_compagnie'])) {
        $compagnies->country_code = $validated['country_code_compagnie'];
    }

    // Gestion du logo
    if ($request->hasFile('logo_compagnies')) {
        $folder = public_path('logo_compagnie');

        // Crée le dossier s'il n'existe pas
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Supprime l'ancien logo s'il existe
        if ($compagnies->logo_compagnies && file_exists($folder . '/' . $compagnies->logo_compagnies)) {
            unlink($folder . '/' . $compagnies->logo_compagnies);
        }

        // Télécharge le nouveau logo
        $file = $request->file('logo_compagnies');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);
        $compagnies->logo_compagnies = $filename;
    } elseif ($request->has('remove_logo') && $compagnies->logo_compagnies) {
        // Suppression du logo si demandé
        $logoPath = public_path('logo_compagnie/' . $compagnies->logo_compagnies);
        if (file_exists($logoPath)) {
            unlink($logoPath);
        }
        $compagnies->logo_compagnies = null;
    }

    $compagnies->save();

    return redirect()->route('compagnies')->with('success', 'Compagnie modifiée avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compagnies $compagnies , $id)
    {
        //
        // dd($compagnies , $id);
        $recupere_compagnie = Compagnies::find($id);
        $recupere_compagnie->status = 3;
        $recupere_compagnie->save();
    return redirect()->route('compagnies')->with('success', 'Désactivation réussie.');
    }


    public function reactiver_supprimer(Compagnies $compagnies , $id)
    {
        $recupere_compagnie = Compagnies::find($id);
        $recupere_compagnie->status = 1;
        $recupere_compagnie->save();
    return redirect()->route('compagnies')->with('success', 'Réactivation réussie.');
    }

    // Approve a pending company (status 2 -> 1) and notify by email
    public function approve($id)
    {
        $compagnie = Compagnies::findOrFail($id);
        if ((int)($compagnie->status) !== 2) {
            return redirect()->back()->with('error', "Cette compagnie n'est pas en attente de validation.");
        }

        $compagnie->status = 1; // validé en activité
        $compagnie->save();

        $encryptedId = Crypt::encryptString($compagnie->id);
        $createAccessUrl = url('/creer-acces/' . $encryptedId);

        // Envoi d'un email moderne avec toutes les informations
        try {
            Mail::to($compagnie->email_compagnies)
                ->send(new CompagnieApprovedMail($compagnie, $createAccessUrl));
        } catch (\Throwable $th) {
            report($th);
        }

        // Message de succès avec lien pour créer les accès
        return redirect()->route('compagnies')->with('success', "La demande a été validée. Lien pour créer les accès: " . $createAccessUrl);
    }

    // Refuse a pending company (status 2 -> 3) with reason and notify by email
    public function refuse(Request $request, $id)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        $compagnie = Compagnies::findOrFail($id);
        if ((int)($compagnie->status) !== 2) {
            return redirect()->back()->with('error', "Cette compagnie n'est pas en attente de validation.");
        }

        $compagnie->status = 3; // désactivation / refus
        $compagnie->save();

        try {
            Mail::to($compagnie->email_compagnies)
                ->send(new CompagnieRefusedMail($compagnie, $validated['reason']));
        } catch (\Throwable $th) {
            report($th);
        }

        return redirect()->route('compagnies')->with('success', 'La demande a été refusée et le motif a été envoyé par email.');
    }

    public function creerAcces($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $compagnie = Compagnies::findOrFail($id);
            $info_users = InfoUser::where('id', $compagnie->info_user_id)->first();
            $users = User::where('id', $info_users->user_id)->first();

            // Vérifier si l'utilisateur a déjà un mot de passe
            if (!empty($users->password)) {
                return view('accesExistant', compact('users'));
            }

            // Si pas de mot de passe, afficher le formulaire de création
            return view('modifierMotdepasse', compact('compagnie', 'info_users', 'users'));

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'Lien invalide ou expiré.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors du traitement de votre demande.');
        }
}


public function updatePassword(Request $request, $id)
{
    // 1️⃣ Validation
    $validated = $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    // 2️⃣ Récupérer l'utilisateur
    $user = User::findOrFail($id);

    // 3️⃣ Hacher et mettre à jour le mot de passe
    $user->password = Hash::make($validated['password']);
    $user->assignRole('super-admin-compagnie');
    $user->save();

    // 4️⃣ Authentifier automatiquement l'utilisateur
    Auth::login($user);

    // 5️⃣ Rediriger avec message
    return redirect()->route('dashboardcompagnie_name')
        ->with('success', 'Mot de passe modifié avec succès ✅');
}


}
