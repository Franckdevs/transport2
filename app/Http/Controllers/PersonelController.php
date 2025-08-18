<?php

namespace App\Http\Controllers;

use App\Models\personnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PersonelController extends Controller
{
    public function index()
    {
        $personnels = Personnel::all();
        return view("personnel.index",compact("personnels"));
    }
       public function store(Request $request)
    {
        // 1. Validation des données
        $user = Auth::user();
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'prenom'    => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email'     => 'required|email',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fonction'  => 'required|in:controleur,gestionnaire,administrateur,gerant',
        ]);

        // 2. Upload de la photo (si existe)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
         $validated['info_user_id'] = $user->info_user->id;

        // 3. Création du bus
        personnel::create($validated);

        // 4. Redirection avec message de succès
        return redirect()->route('personnel.index')->with('success', 'Enregistrement effectué avec succès.');
    }
    public function create()
    {
        return view("personnel.create");
    }
}
