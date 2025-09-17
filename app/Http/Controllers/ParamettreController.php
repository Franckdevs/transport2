<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
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
