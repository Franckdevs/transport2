<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\chauffeur;


class ChauffeurController extends Controller
{
    public function index()
    {
        $chauffeurs = Chauffeur::get();

        return view("compagnie.chauffeur.index", compact("chauffeurs"));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        
   $validated = $request->validate([
    'nom'            => 'required|string|max:255',
    'prenom'         => 'required|string|max:255',
    'adresse'        => 'required|string|max:255',
    'telephone'      => 'required|string|max:50|unique:personnels,telephone',
    'numeros_permis' => 'nullable|string|max:50',  // texte
    'date_naissance' => 'nullable|date',
    'photo'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // image
]);


        $validated['info_user_id'] = $user->info_user->id;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('chauffeurs', 'public');
            $validated['photo'] = $photoPath;
        }
    $validated['status'] = 'disponible';

   $chauffeurs = chauffeur::create($validated);

        // 4. Redirection
       return redirect()->route('chauffeur.index', compact('chauffeurs'))
                 ->with('success', 'chauffeur ajouté avec succès.');

    }
    public function create()
    {

        return view("compagnie.chauffeur.create");
    }
}