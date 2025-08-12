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
    // Validation des champs email et password
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
        }

        // Optionnel : redirection par défaut si rôle non géré
        // return redirect()->route('home')
        //     ->with('success', 'Connexion réussie. Bienvenue ' . $user->nom . ' ' . $user->prenom);
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
        //  $nombres_compagnie = Compagnies::count();
        return view('compagnie.index');
    }


        public function premierePage()
    {
        return view('login');
    }

    public function logout(Request $request)
{
    Auth::logout(); // Déconnecte l'utilisateur

    $request->session()->invalidate(); // Invalide la session
    $request->session()->regenerateToken(); // Regénère le token CSRF

    return redirect('/')->with('success', 'Déconnexion réussie.');
}


// public function compagnie()
// {
//     return view('betro.compagnie.index');
// }


}
