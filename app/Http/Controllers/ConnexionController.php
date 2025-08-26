<?php

namespace App\Http\Controllers;

use App\Models\Compagnies;
use App\Models\Connexion;
use App\Http\Requests\StoreConnexionRequest;
use App\Http\Requests\UpdateConnexionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
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
    public function store(StoreConnexionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Connexion $connexion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Connexion $connexion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConnexionRequest $request, Connexion $connexion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Connexion $connexion)
    {
        //
    }

    //   public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         return view('betro.index' , compact('email'));
    //     }
    // }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    // Tentative d'authentification avec les credentials
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // Protection contre la fixation de session

        $user = Auth::user();
// dd($user->getRoleNames()); // Affiche une collection avec les rôles de l'utilisateur  // <-- Affiche la valeur du rôle et stoppe l'exécution
        // Redirection selon le rôle de l'utilisateur
        if ($user->hasRole('super-admin-betro')) {
            return redirect()->route('dashboard')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        } elseif ($user->hasRole('super-admin-compagnie')) {
            return redirect()->route('dashboardcompagnie_name')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        }elseif($user->hasRole('super-admin-gare')){
            return redirect()->route('dashboardcompagnie_name')
                ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
        }
    }

    // Si échec de connexion, retour avec message d'erreur
    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->onlyInput('email');
}


    // if ($user->role = 'super-admin-betro') {
    //     // return redirect()->route('dashboardbetro'); // ou la vue que tu veux afficher
    //     return redirect()->route('dashboard') // ou la vue que tu veux afficher
    //     ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
    //     }else{
    //     return redirect()->route('dashboardcompagnie_name')
    //     ->with('success', 'Mot de passe modifié avec succès ✅');
    //     }

    public function dashboardbetro()
    {
        $nombres_compagnie = Compagnies::count();
        return view('betro.index' , compact('nombres_compagnie'));
    }

        public function dashboardcompagnie()
    {
        $user = auth()->user();
    $role = $user->getRoleNames()->first(); // Récupère le premier rôle (ou adapte si multi-rôles)


// dd($user->getAllPermissions()->pluck('name'));
        // Debug: Afficher les rôles et permissions de l'utilisateur connecté

        // dd([
        //     'user_id' => $user->id,
        //     'user_name' => $user->name,
        //     'user_email' => $user->email,
        //     'roles' => $user->getRoleNames(),
        //     'permissions_from_role' => $user->getPermissionsViaRoles()->pluck('name'),
        //     'direct_permissions' => $user->getDirectPermissions()->pluck('name'),
        //     'all_permissions' => $user->getAllPermissions()->pluck('name'),
        //     'has_super_admin_gare' => $user->hasRole('super-admin-gare'),
        //     'can_view_dashboard_gare' => $user->can('view-dashboard-gare'),
        //     'can_manage_quais' => $user->can('manage-quais')
        // ]);

        //  $nombres_compagnie = Compagnies::count();
        return view('compagnie.index');
    }


        public function premierePage()
    {
        return view('login');
    }

    public function logins()
    {
        return view('login');
    }

public function logout(Request $request)
{
    // Déconnecte l'utilisateur
    Auth::logout();

    // Invalide la session Laravel
    $request->session()->invalidate();

    // Regénère le token CSRF
    $request->session()->regenerateToken();

    // Supprime tous les cookies de session (y compris laravel_session et XSRF-TOKEN)
    foreach ($request->cookies->keys() as $cookieName) {
        cookie()->forget($cookieName);
    }

    // Retour avec headers pour interdire le cache
    return redirect('/login')->with('success', 'Déconnexion réussie.')
        ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
}



// public function compagnie()
// {
//     return view('betro.compagnie.index');
// }


}
