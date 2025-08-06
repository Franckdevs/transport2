<?php

namespace App\Http\Controllers;

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

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // protection contre les attaques de session fixation

        $user = Auth::user(); // si tu veux accéder à l'utilisateur connecté

        return redirect()->route('dashboard') // ou la vue que tu veux afficher
            ->with('success', 'Connexion réussie. Bienvenue ' . $user->name);
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->onlyInput('email');
}

    public function dashboard()
    {
        return view('betro.index');
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
