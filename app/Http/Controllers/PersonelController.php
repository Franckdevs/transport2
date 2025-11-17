<?php

namespace App\Http\Controllers;

use App\Models\personnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleUtilisateur;
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
    $user = Auth::user();

    $validated = $request->validate([
        'nom'       => 'required|string|max:255',
        'prenom'    => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email'     => 'required|email',
        'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:102400',
        'role_utilisateurs_id' => 'required',
    ]);

    // Définir le dossier de stockage
    $directory = storage_path('app/public/photo_personnel');

    // Créer le dossier s'il n'existe pas
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    // Upload de la photo dans le dossier créé
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        // $folder = public_path('chauffeurs');
         $folder = public_path('photo_personnel');
        $filename = time() . '_' . $file->getClientOriginalName(); // Nom unique
        $file->move($folder, $filename); // Déplacer le fichier
        $validated['photo'] = 'photo_personnel/' . $filename; // Chemin relatif pour la DB
    }

    $validated['info_user_id'] = $user->info_user->id;

    // Création du personnel
    $validated['status'] = 1; // Actif par défaut
    personnel::create($validated);

    return redirect()->route('personnel.index')->with('success', 'Enregistrement effectué avec succès.');
}



// public function update(Request $request, $id)
// {
//     $user = Auth::user();
//     $personnel = Personnel::findOrFail($id);

//     // 1. Validation
//     $validated = $request->validate([
//         'nom'       => 'required|string|max:255',
//         'prenom'    => 'required|string|max:255',
//         'telephone' => 'required|string|max:20',
//         'email'     => 'required|email',
//         'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240', // 10 Mo max
//         'role_utilisateurs_id' => 'required',
//     ]);

//     // 2. Création du dossier si inexistant
//     $folder = public_path('photo_personnel');
//     if (!file_exists($folder)) {
//         mkdir($folder, 0755, true);
//     }

//     // 3. Gestion de la photo
//     if ($request->hasFile('photo')) {
//         $file = $request->file('photo');
//         $filename = time() . '_' . $file->getClientOriginalName();

//         // Déplacer la nouvelle photo
//         $file->move($folder, $filename);

//         // Supprimer l’ancienne photo si elle existe
//         if (!empty($personnel->photo) && file_exists(public_path($personnel->photo))) {
//             unlink(public_path($personnel->photo));
//         }

//         // Mettre à jour le chemin dans la DB
//         $validated['photo'] = 'photo_personnel/' . $filename;
//     } else {
//         // Conserver l'ancienne photo si aucune nouvelle n'est envoyée
//         $validated['photo'] = $personnel->photo;
//     }

//     // 4. Lier au bon user
//     $validated['info_user_id'] = $user->info_user->id;

    
//     // 5. Mise à jour
//     $validated['status'] = 1; // Actif par défaut
//     $personnel->update($validated);

//     // 6. Redirection
//     return redirect()->route('personnel.index')->with('success', 'Modification effectuée avec succès.');
// }


public function update(Request $request, $id)
{
    $user = Auth::user();
    $personnel = Personnel::findOrFail($id);

    // 1. Validation
    $validated = $request->validate([
        'nom'       => 'required|string|max:255',
        'prenom'    => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email'     => 'required|email',
        'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240', // 10 Mo max
        'role_utilisateurs_id' => 'required',
    ]);

    // 2. Création du dossier photo si inexistant
    $folder = public_path('photo_personnel');
    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
    }

    // 3. Gestion de la photo
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Déplacer la nouvelle photo
        $file->move($folder, $filename);

        // Supprimer l’ancienne photo si elle existe
        if (!empty($personnel->photo) && file_exists(public_path($personnel->photo))) {
            unlink(public_path($personnel->photo));
        }

        // Mettre à jour le chemin dans la DB
        $validated['photo'] = 'photo_personnel/' . $filename;
    } else {
        // Conserver l'ancienne photo si aucune nouvelle n'est envoyée
        $validated['photo'] = $personnel->photo;
    }

    // 4. Empêcher la modification du téléphone ou de l’e-mail s’ils sont identiques
    if ($request->telephone === $personnel->telephone) {
        unset($validated['telephone']);
    }

    if ($request->email === $personnel->email) {
        unset($validated['email']);
    }

    // 5. Lier au bon user
    $validated['info_user_id'] = $user->info_user->id;

    // 6. Mettre le statut par défaut
    $validated['status'] = 1;

    // 7. Mise à jour
    $personnel->update($validated);

    // 8. Redirection
    return redirect()->route('personnel.index')
                     ->with('success', 'Modification effectuée avec succès.');
}

    public function create()
    {
        $rolepersonnels = RoleUtilisateur::all();
        return view("personnel.create" , compact('rolepersonnels'));
    }

    
public function show($id)
{
    // Récupère le personnel avec sa relation RolePersonnel
    $personnel = Personnel::with('RolePersonnel')->findOrFail($id);
    // dd($personnel);
    return view("personnel.show", compact("personnel"));
}

public function edit($id)
{
    //Récupère le personnel avec sa relation RolePersonnel
    $personnel = Personnel::with('RolePersonnel')->findOrFail($id);
    $rolepersonnels = RoleUtilisateur::all();
    //dd($personnel);
    return view("personnel.edit", compact("personnel","rolepersonnels"));
}

public function destroy($id)
{
    $personnel = Personnel::findOrFail($id);
    $personnel->status = 3; // Supprimé / Inactif
    $personnel->save();

    return redirect()->back()->with('success', 'Personnel supprimé avec succès.');
}

public function destroy_reactivation($id)
{
    $personnel = Personnel::findOrFail($id);
    $personnel->status = 1; // Réactivation
    $personnel->save();

    return redirect()->back()->with('success', 'Personnel réactivé avec succès.');
}


}
