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
    public function edit(gare $gare)
    {
        //
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
    $listegares = Gare::orderBy('id', 'desc')->paginate(10); // 10 par page
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
    $garePermissions = Permission::where('name', 'NOT LIKE', '%Betro%')->get();
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

}
