<?php

namespace App\Http\Controllers;

use App\Models\gare;
use App\Http\Requests\StoregareRequest;
use App\Http\Requests\UpdategareRequest;
use App\Models\InfoUser;
use App\Models\Jour;
use App\Models\Ville;
use App\Models\User;
use App\Mail\AdminGareCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;

class GareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoregareRequest $request)
    {
        //
    }

    public function store2(Request $request)
    {
        $currentUser = Auth::user();

        try {
            // 1️⃣ Validation
            $validated = $request->validate([
            'nom_gare' => 'nullable',
            'adresse_gare'=> 'nullable',
            'telephone_gare'=> 'nullable',
            'ville_id'=> 'nullable|exists:villes,id',
            // 'jour_id'=> 'nullable|exists:jours,id',
            'jour_ouvert_id'=> 'nullable|exists:jours,id',
            'jour_de_fermeture_id'=> 'nullable|exists:jours,id',
            // 'nombre_quais'=> 'nullable',
            'latitude'=> 'nullable',
            'longitude'=> 'nullable',
            'heure_ouverture'=> 'nullable',
            'heure_fermeture'=> 'nullable',
            'parking_disponible'=> 'boolean',
            'wifi_disponible'=> 'boolean',
            'telephone'=> 'nullable',
            'email'=> 'nullable|email',
            'site_web'=> 'nullable',
            'description'=> 'nullable',
            // Champs administrateur
            'admin_nom' => 'nullable|string|max:255',
            'admin_prenom' => 'nullable|string|max:255',
            'admin_email' => 'nullable|email|unique:users,email',
            'admin_telephone' => 'nullable|string|max:20',
            'admin_permissions' => 'nullable|array',
            'admin_permissions.*' => 'exists:permissions,name',
            'compagnie_id' => 'nullable|exists:compagnies,id',
            'id_admin_creation' => 'nullable|exists:users,id',
        ]);

        // 2️⃣ Créer l'utilisateur administrateur de la gare si les infos sont fournies
        $adminInfoUserId = null;
        if ($validated['admin_email'] && ($validated['admin_nom'] || $validated['admin_prenom'])) {
            // Créer l'utilisateur
            $user = User::create([
                'name' => trim(($validated['admin_prenom'] ?? '') . ' ' . ($validated['admin_nom'] ?? '')),
                'email' => $validated['admin_email'],
                'nome' => $validated['admin_nom'] ?? '',
                'prenom' => $validated['admin_prenom'] ?? '',
                // 'password' => Hash::make('password123'), // Mot de passe par défaut
                'email_verified_at' => now(),
                'id_admin_creation' => $currentUser->id, // L'utilisateur actuel comme créateur
            ]);

            // compagnie_id

            // Créer InfoUser associé
            $infoUser = InfoUser::create([
                'user_id' => $user->id,
                'nom' => $validated['admin_nom'],
                'prenom' => $validated['admin_prenom'],
                'telephone' => $validated['admin_telephone'],
                'email' => $validated['admin_email'],
            ]);

            // Assigner le rôle super-admin-gare
            $user->assignRole('super-admin-gare');

            // Assigner les permissions personnalisées si sélectionnées
            if (!empty($validated['admin_permissions'])) {
                $user->givePermissionTo($validated['admin_permissions']);
            }

            $adminInfoUserId = $infoUser->id;
        }

        // 3️⃣ Préparer les données de la gare
        $gareData = collect($validated)->except(['admin_nom', 'admin_prenom', 'admin_email', 'admin_telephone', 'admin_permissions'])->toArray();

        // Utiliser l'admin créé ou l'utilisateur actuel
        $gareData['info_user_id'] = $adminInfoUserId ?? $currentUser->info_user->id;

        // 4️⃣ Création de la gare
        $gare = Gare::create($gareData);

        // 5️⃣ Envoyer l'email à l'administrateur si créé
        if ($adminInfoUserId && $user) {
            try {
                Mail::to($user->email)->send(new AdminGareCreatedMail($user, $gare));
                $emailStatus = ' Email de bienvenue envoyé.';
            } catch (\Exception $e) {
                $emailStatus = ' Erreur lors de l\'envoi de l\'email.';
            }
        } else {
            $emailStatus = '';
        }

            return redirect()->route('gares.index.2')
                ->with('success', 'Gare créée avec succès ✅' . ($adminInfoUserId ? ' et administrateur créé.' : '') . $emailStatus);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de la gare: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Erreur lors de la création de la gare: ' . $e->getMessage())
                ->withInput();
        }
    }


public function update2(Request $request, $id)
{
    $currentUser = Auth::user();
    
    try {
        // Récupérer la gare et l'utilisateur existant
        $gare = Gare::findOrFail($id);
        $user = $gare->infoUser ? $gare->infoUser->user : null;
        
        // 1️⃣ Validation
        $validated = $request->validate([
            'nom_gare' => 'nullable',
            'adresse_gare' => 'nullable',
            'telephone_gare' => 'nullable',
            'ville_id' => 'nullable|exists:villes,id',
            'jour_ouvert_id' => 'nullable|exists:jours,id',
            'jour_de_fermeture_id' => 'nullable|exists:jours,id',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'heure_ouverture' => 'nullable',
            'heure_fermeture' => 'nullable',
            'parking_disponible' => 'boolean',
            'wifi_disponible' => 'boolean',
            'telephone' => 'nullable',
            'email' => 'nullable|email',
            'site_web' => 'nullable',
            'description' => 'nullable',
            // Champs administrateur
            'admin_nom' => 'nullable|string|max:255',
            'admin_prenom' => 'nullable|string|max:255',
            'admin_email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user ? $user->id : null),
                Rule::unique('info_users', 'email')->ignore($gare->info_user_id)
            ],
            'admin_telephone' => 'nullable|string|max:20',
            'admin_permissions' => 'nullable|array',
            'admin_permissions.*' => 'exists:permissions,name',
        ]);

        if (!empty($validated['admin_email']) && ($validated['admin_nom'] || $validated['admin_prenom'])) {
            if ($user) {
                // Mettre à jour l'utilisateur existant

                // Mettre à jour User
                $user->update([
                    'name' => trim(($validated['admin_prenom'] ?? '') . ' ' . ($validated['admin_nom'] ?? '')),
                    'email' => $validated['admin_email'],
                    'prenom' => $validated['admin_prenom'] ?? '',
                    'nom' => $validated['admin_nom'] ?? '',
                ]);

                // Mettre à jour InfoUser
                $user->info_user->update([
                    'nom' => $validated['admin_nom'],
                    'prenom' => $validated['admin_prenom'],
                    'telephone' => $validated['admin_telephone'],
                    'email' => $validated['admin_email'],
                ]);

            } else {
                // Créer un nouvel utilisateur admin
                $user = User::create([
                    'name' => trim(($validated['admin_prenom'] ?? '') . ' ' . ($validated['admin_nom'] ?? '')),
                    'email' => $validated['admin_email'],
                    'prenom' => $validated['admin_prenom'] ?? '',
                    'nom' => $validated['admin_nom'] ?? '',
                    'email_verified_at' => now(),
                ]);

                $infoUser = InfoUser::create([
                    'user_id' => $user->id,
                    'nom' => $validated['admin_nom'],
                    'prenom' => $validated['admin_prenom'],
                    'telephone' => $validated['admin_telephone'],
                    'email' => $validated['admin_email'],
                ]);

                $user->assignRole('super-admin-gare');

                // Lier la gare au nouvel InfoUser
                $gare->info_user_id = $infoUser->id;
            }

            // 4️⃣ Assigner les permissions
            if (!empty($validated['admin_permissions'])) {
                $user->syncPermissions($validated['admin_permissions']); // remplace les permissions existantes
            }
        }

        // 5️⃣ Mettre à jour les données de la gare avec gestion des champs booléens
        $gare->update([
            'nom_gare' => $validated['nom_gare'] ?? $gare->nom_gare,
            'adresse_gare' => $validated['adresse_gare'] ?? $gare->adresse_gare,
            'telephone_gare' => $validated['telephone_gare'] ?? $gare->telephone_gare,
            'ville_id' => $validated['ville_id'] ?? $gare->ville_id,
            'jour_ouvert_id' => $validated['jour_ouvert_id'] ?? $gare->jour_ouvert_id,
            'jour_de_fermeture_id' => $validated['jour_de_fermeture_id'] ?? $gare->jour_de_fermeture_id,
            'latitude' => $validated['latitude'] ?? $gare->latitude,
            'longitude' => $validated['longitude'] ?? $gare->longitude,
            'heure_ouverture' => $validated['heure_ouverture'] ?? $gare->heure_ouverture,
            'heure_fermeture' => $validated['heure_fermeture'] ?? $gare->heure_fermeture,
            'parking_disponible' => $request->input('parking_disponible', 0) == 1,
            'wifi_disponible' => $request->input('wifi_disponible', 0) == 1,
            'telephone' => $validated['telephone'] ?? $gare->telephone,
            'email' => $validated['email'] ?? $gare->email,
            'site_web' => $validated['site_web'] ?? $gare->site_web,
            'description' => $validated['description'] ?? $gare->description,
        ]);

        return redirect()->route('gares.index.2')
            ->with('success', 'Gare mise à jour avec succès ✅');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la mise à jour de la gare: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la gare: ' . $e->getMessage())->withInput();
    }
}



    /**
     * Display the specified resource.
     */
    public function show($gars)
    {
        //
        $gare = gare::find($gars);
        // dd($gare);

        return view('compagnie.gares.show', compact('gare'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(gare $gare ,$id)
{
    $gare = Gare::find($id);
$garePermissions = Permission::where('name', 'NOT LIKE', '%Betro%')
    ->where('name', 'NOT LIKE', '%ajouter%')
        ->where('name', 'NOT LIKE', '%tout-les-permissions%')

    ->get();
    // $garePermissions = Permission::where('name', 'NOT LIKE', '%Betro%')->get();

    $compagnie_id = Auth::user()->info_user->compagnie->id;

    // Récupérer l'utilisateur lié à la gare
    $user = $gare->infoUser ? $gare->infoUser->user : null;

    return view('compagnie.gares.edit', [
        'infoUsers'    => InfoUser::all(),
        'jours'        => Jour::all(),
        'villes'       => Ville::all(),
        'permissions'  => $garePermissions,
        'compagnie_id' => $compagnie_id,
        'gare'         => $gare,
        'user'         => $user, // ← ajouté ici
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategareRequest $request, gare $gare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gare $gare)
    {
        //
    }

public function index2()
{
    $user = Auth::user();
    $listegares = Gare::where('info_user_id', '!=', $user->id)
    ->orderBy('id', 'desc')
    ->paginate(10); // 10 par page
    return view('compagnie.gares.index', compact('listegares'));
}


// public function create2()
// {
//    // Récupérer les permissions liées aux gares
//    $garePermissions = Permission::all();

//    return view('compagnie.gares.create', [
//         'infoUsers' => InfoUser::all(),
//         'jours' => Jour::all(),
//         'villes' => Ville::all(),
//         'permissions' => $garePermissions,
//     ]);
// }

public function create2()
{
    // Récupérer toutes les permissions sauf celles qui contiennent "Betro"
    // $garePermissions = Permission::where('name', 'NOT LIKE', '%Betro%')->get();
    $garePermissions = Permission::where('name', 'NOT LIKE', '%Betro%')
    ->where('name', 'NOT LIKE', '%ajouter%')
        ->where('name', 'NOT LIKE', '%tout-les-permissions%')
    ->get();
    $compagnie_id = Auth::user()->info_user->compagnie->id;

    return view('compagnie.gares.create', [
        'infoUsers'   => InfoUser::all(),
        'jours'       => Jour::all(),
        'villes'      => Ville::all(),
        'permissions' => $garePermissions,
        'compagnie_id' => $compagnie_id,
    ]);
}


public function ajouterbUS(gare $gare)
{
    $gares = gare::where('id', $gare->id);
    // dd($gares );
    return view('compagnie.gares.bus', compact('gares'));
}


public function destroy_desactiver($id)
{
    $personnel = gare::findOrFail($id);
    $personnel->status = 3; // Supprimé / Inactif
    $personnel->save();

    return redirect()->back()->with('success', 'Personnel supprimé avec succès.');
}

public function destroy_reactivation($id)
{
    $personnel = gare::findOrFail($id);
    $personnel->status = 1; // Réactivation
    $personnel->save();

    return redirect()->back()->with('success', 'Personnel réactivé avec succès.');
}

}
