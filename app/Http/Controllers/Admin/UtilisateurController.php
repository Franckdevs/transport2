<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
    public function index()
    {
        $utilisateurs = Utilisateur::latest()->paginate(10);
        return view('betro.utilisateur.index', compact('utilisateurs'));
    }

    /**
     * Afficher le formulaire de création d'utilisateur
     */
    public function create()
    {
        return view('betro.utilisateur.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher les détails d'un utilisateur
     */
    public function show(Utilisateur $utilisateur)
    {
        return view('betro.utilisateur.show', compact('utilisateur'));
    }

    /**
     * Afficher le formulaire de modification d'un utilisateur
     */
    public function edit(Utilisateur $utilisateur)
    {
        return view('betro.utilisateur.edit', compact('utilisateur'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs,email,' . $utilisateur->id,
            'telephone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $utilisateur->update($data);

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Bloquer/Réactiver un utilisateur
     */
    public function destroy(Utilisateur $utilisateur)
    {
        // Empêcher de bloquer son propre compte
        // dd($utilisateur);
        // if (auth()->id() === $utilisateur->id) {
        //     return redirect()->back()
        //         ->with('error', 'Vous ne pouvez pas bloquer votre propre compte.');
        // }
        // Inverser le statut actuel ('1' -> actif, '3' -> bloqué)
        $utilisateur->status = $utilisateur->status == '1' ? '3' : '1';
        // dd($utilisateur);
        $utilisateur->save();

        $message = $utilisateur->status == '1' 
            ? 'Utilisateur réactivé avec succès.' 
            : 'Utilisateur bloqué avec succès.';

        return redirect()->back()->with('success', $message);
        // return redirect()->route('admin.utilisateurs.index')
        //     ->with('success', $message);
    }
}
