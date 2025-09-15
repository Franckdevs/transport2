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

    // Messages personnalisés
    $messages = [
        'nom.required'        => 'Le nom est obligatoire.',
        'prenom.required'     => 'Le prénom est obligatoire.',
        'telephone.unique'    => 'Ce numéro de téléphone existe déjà.',
        'photo.image'         => 'Le fichier doit être une image valide.',
        'photo.mimes'         => 'Le fichier doit être au format jpg, jpeg, png ou gif.',
        'photo.max'           => 'La taille maximale de l\'image est de 2 Mo.',
        'date_naissance.date' => 'La date de naissance n\'est pas valide.',
    ];

    // Validation
    $validated = $request->validate([
        'nom'            => 'required|string|max:255',
        'prenom'         => 'required|string|max:255',
        'adresse'        => 'nullable|string|max:255',
        'telephone'      => 'required|string|max:50|unique:personnels,telephone',
        'numeros_permis' => 'nullable|string|max:50',
        'date_naissance' => 'nullable|date',
        'photo'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ], $messages);
    
    // dd($validated);
    // Condition pour vérifier que la requête existe
    if ($request) {

        $validated['info_user_id'] = $user->info_user->id;

        // Gestion du fichier photo
        if ($request->hasFile('photo')) {
            $folder = public_path('chauffeurs');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($folder, $filename);

            $validated['photo'] = 'chauffeurs/' . $filename;
        }

        $validated['status'] = 'disponible';

        // Création du chauffeur
        $chauffeur = Chauffeur::create($validated);

        // Redirection avec message succès
        return redirect()->route('chauffeur.index')
                         ->with('success', 'Chauffeur ajouté avec succès !');
    }

    // Optionnel : message si la requête n'est pas valide
    return redirect()->back()->with('error', 'Impossible d’ajouter le chauffeur.');
}




    public function create()
    {
        return view("compagnie.chauffeur.create");
    }

        public function edit($id)
    {
        $chauffeur = Chauffeur::find($id);
        return view("compagnie.chauffeur.edit" , compact("chauffeur"));
    }

}