<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\chauffeur;


class ChauffeurController extends Controller
{
    public function index2()
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
        // 'adresse'        => 'nullable|string|max:255',
        'telephone'      => 'required|string|max:50|unique:personnels,telephone',
        'numeros_permis' => 'nullable|string|max:50',
        'date_naissance' => 'nullable|date',
        'photo'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:102400',
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

        $validated['status'] = 1;

        // Création du chauffeur
        $chauffeur = Chauffeur::create($validated);

        // Redirection avec message succès
        return redirect()->route('chauffeur.index')
                         ->with('success', 'Chauffeur ajouté avec succès !');
    }

    // Optionnel : message si la requête n'est pas valide
    return redirect()->back()->with('error', 'Impossible d’ajouter le chauffeur.');
}


public function show($id)
{
    $chauffeur = Chauffeur::findOrFail($id); // trouve ou renvoie 404 si inexistant
    return view("compagnie.chauffeur.show", compact('chauffeur'));
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

//     public function update(Request $request, $id)
// {
//     $user = Auth::user();

//     // Messages personnalisés
//     $messages = [
//         'nom.required'        => 'Le nom est obligatoire.',
//         'prenom.required'     => 'Le prénom est obligatoire.',
//         'telephone.unique'    => 'Ce numéro de téléphone existe déjà.',
//         'photo.image'         => 'Le fichier doit être une image valide.',
//         'photo.mimes'         => 'Le fichier doit être au format jpg, jpeg, png ou gif.',
//         'photo.max'           => 'La taille maximale de l\'image est de 100 Mo.',
//         'date_naissance.date' => 'La date de naissance n\'est pas valide.',
//     ];

//     // Récupération du chauffeur
//     $chauffeur = Chauffeur::findOrFail($id);
//     // Validation
//     $validated = $request->validate([
//         'nom'            => 'required|string|max:255',
//         'prenom'         => 'required|string|max:255',
//         'adresse'        => 'nullable|string|max:255',
//         'telephone'      => 'required|string|max:50|unique:personnels,telephone,' . $chauffeur->id,
//         'numeros_permis' => 'nullable|string|max:50',
//         'date_naissance' => 'nullable|date',
//         'photo'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:102400',
//     ], $messages);

//     $validated['info_user_id'] = $user->info_user->id;
//     // dd($validated);
//     // Gestion du fichier photo
//     if ($request->hasFile('photo')) {
//         $folder = public_path('chauffeurs');
//         if (!file_exists($folder)) {
//             mkdir($folder, 0755, true);
//         }

//         $file = $request->file('photo');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $file->move($folder, $filename);

//         $validated['photo'] = 'chauffeurs/' . $filename;
//     } else {
//         // Si aucune image fournie, mettre à null
//         $validated['photo'] = null;
//     }
//     // Mise à jour du chauffeur
//     $chauffeur->update($validated);
//     // Redirection avec message succès
//     return redirect()->route('chauffeur.index')
//     ->with('success', 'Chauffeur mis à jour avec succès !');
// }

public function update(Request $request, $id)
{
    $user = Auth::user();

    // Messages personnalisés
    $messages = [
        'nom.required'        => 'Le nom est obligatoire.',
        'prenom.required'     => 'Le prénom est obligatoire.',
        'telephone.unique'    => 'Ce numéro de téléphone existe déjà.',
        'photo.image'         => 'Le fichier doit être une image valide.',
        'photo.mimes'         => 'Le fichier doit être au format jpg, jpeg, png ou gif.',
        'photo.max'           => 'La taille maximale de l\'image est de 100 Mo.',
        'date_naissance.date' => 'La date de naissance n\'est pas valide.',
    ];

    // Récupération du chauffeur
    $chauffeur = Chauffeur::findOrFail($id);

    // Validation
    $validated = $request->validate([
        'nom'            => 'required|string|max:255',
        'prenom'         => 'required|string|max:255',
        // 'adresse'        => 'nullable|string|max:255',
        'telephone'      => 'required|string|max:50|unique:personnels,telephone,' . $chauffeur->id,
        'numeros_permis' => 'nullable|string|max:50',
        'date_naissance' => 'nullable|date',
        'photo'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:102400',
    ], $messages);

    // Gestion de l'image
    if ($request->hasFile('photo')) {
        $folder = public_path('chauffeurs');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);

        $validated['photo'] = 'chauffeurs/' . $filename;
    } else {
        // ⚠️ Si aucune nouvelle photo, on garde l'ancienne
        unset($validated['photo']);
    }

    // Ajout de l'info_user_id uniquement s'il n'est pas déjà défini
    $validated['info_user_id'] = $user->info_user->id ?? $chauffeur->info_user_id;

    // ⚙️ Mise à jour uniquement des champs réellement saisis
    foreach ($validated as $key => $value) {
        if (!is_null($value) && $value !== '') {
            $chauffeur->$key = $value;
        }
    }

    $chauffeur->save();

    // Redirection avec message succès
    return redirect()->route('chauffeur.index')
        ->with('success', 'Chauffeur mis à jour avec succès !');
}



public function destroy($id)
{
    // dd($id);
    $chauffeur = Chauffeur::find($id);
    if (!$chauffeur) {
        return redirect()->back()->with('error', 'Chauffeur introuvable.');
    }
    if ($chauffeur->status == 1) {
        $chauffeur->status = 3; // 3 = Supprimé / Inactif
        $chauffeur->save();  
        return redirect()->back()->with('success', 'Chauffeur supprimé avec succès.'); 
    }elseif($chauffeur->status == 3){
        $chauffeur->status = 1; // 1 = Réactivé
        $chauffeur->save();
        return redirect()->back()->with('success', 'Le chauffeur est à nouveau activé.');
    }else{
        return redirect()->back()->with('error', 'Le chauffeur est déjà désactivé.');
    }

    // return redirect()->back()->with('success', 'Chauffeur supprimé avec succès.');
}

public function destroy_reactivation($id)
{
    // dd($id);
    $chauffeur = Chauffeur::find($id);
    if (!$chauffeur) {
        return redirect()->back()->with('error', 'Chauffeur introuvable.');
    }
    $chauffeur->status = 1; // 1 = Réactivé
    $chauffeur->save();

    return redirect()->back()->with('success', 'Chauffeur réactivé avec succès.');
}



}