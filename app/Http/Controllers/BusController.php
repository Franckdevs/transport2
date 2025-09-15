<?php

namespace App\Http\Controllers;

use App\Models\bus;
use App\Models\ConfigurationPlaceBus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatebusRequest;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $bus = Bus::all();
    return view("compagnie.bus.index",compact("bus"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view("compagnie.bus.create");
    }

    /**
     * Store a newly created resource in storage.
 */

//     public function store(Request $request)
// {
//     $user = Auth::user();

//     // 1. Validation des données
//     $validated = $request->validate([
//         'nom_bus'              => 'required|string|max:255',
//         'marque_bus'           => 'required|string|max:255',
//         'modele_bus'           => 'required|string|max:255',
//         'immatriculation_bus'  => 'required|string|max:50|unique:buses,immatriculation_bus',
//         'photo_bus'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
//         'description_bus'      => 'nullable|string',
//         'localisation_bus'     => 'nullable|string|max:255',
//         'nombre_places'        => 'required|integer|min:1',
//         //'configuration_car'    => 'nullable', // on contrôle les valeurs possibles
//         // 'configuration_place_id'=> 'required',
//     ]);



//     // Ajout de l'ID de l'utilisateur relié
//     $validated['info_user_id'] = $user->info_user->id;
//     // 2. Gestion de la photo
//     if ($request->hasFile('photo_bus')) {
//         $photoPath = $request->file('photo_bus')->store('buses', 'public');
//         $validated['photo_bus'] = $photoPath;
//     }
//     // 3. Sauvegarde en base de données
//     $bus = Bus::create($validated);
//     // 4. Redirection avec succès
//     return redirect()->route('compagnie.bus', compact('bus'))
//                      ->with('success', 'Bus ajouté avec succès.');
// }

public function store(Request $request)
{
    $user = Auth::user();

    // 1. Validation des données
    $validated = $request->validate([
        'nom_bus'              => 'required|string|max:255',
        'marque_bus'           => 'required|string|max:255',
        'modele_bus'           => 'required|string|max:255',
        'immatriculation_bus'  => 'required|string|max:50|unique:buses,immatriculation_bus',
        'photo_bus'            => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'description_bus'      => 'nullable|string',
        'localisation_bus'     => 'nullable|string|max:255',
        'nombre_places'        => 'required|integer|min:1',
        'configuration_place_id' => 'required|integer|exists:configuration_place_buses,id',
    ]);

    // Ajout de l'ID de l'utilisateur relié
    $validated['info_user_id'] = $user->info_user->id;

    // Ajout de l'ID de la configuration
    $validated['configuration_place_buses_id'] = $validated['configuration_place_id'];
    unset($validated['configuration_place_id']); // on n'envoie pas cette clé à la création

    // 2. Gestion de la photo
    // if ($request->hasFile('photo_bus')) {
    //     $photoPath = $request->file('photo_bus')->store('buses', 'public');
    //     $validated['photo_bus'] = $photoPath;
    // }
    if ($request->hasFile('photo_bus')) {
    // Chemin du dossier public/buses
    $folder = public_path('buses');

    // Crée le dossier s'il n'existe pas
    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
    }

    // Récupère le fichier
    $file = $request->file('photo_bus');

    // Génère un nom unique
    $filename = time() . '_' . $file->getClientOriginalName();

    // Déplace le fichier dans le dossier
    $file->move($folder, $filename);

    // Sauvegarde le chemin relatif pour la base de données
    $validated['photo_bus'] = 'buses/' . $filename;
}
    // dd($validated);
    // 3. Sauvegarde en base de données
    $bus = Bus::create($validated);

    // 4. Redirection avec succès
    return redirect()->route('compagnie.bus', compact('bus'))
    ->with('success', 'Bus ajouté avec succès.');
}
 

    /**
     * Display the specified resource.
     */
    public function show(bus $bus)
    {
        //
        $bus = Bus::find($bus->id);
        $configuration = ConfigurationPlaceBus::where('id', $bus->configuration_place_buses_id)->first();
        return view("compagnie.bus.show",compact("bus","configuration"));
    }

    /**
     *
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bus = Bus::find($id);
        return view("compagnie.bus.edit",compact("bus"));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update($id)
    // {
    //     //
    //     $busupdate = Bus::find($id);
    //     $request = request();
    //     $busupdate->nom_bus = $request->nom_bus;
    //     $busupdate->marque_bus = $request->marque_bus;
    //     $busupdate->modele_bus = $request->modele_bus;
    //     $busupdate->immatriculation_bus = $request->immatriculation_bus;
    //     $busupdate->photo_bus = $request->photo_bus;
    //     $busupdate->description_bus = $request->description_bus;
    //     $busupdate->localisation_bus = $request->localisation_bus;
    //     $busupdate->configuration_place_buses_id = $request->configuration_place_id;
    //     $busupdate->save();
    //     $bus = Bus::all();

    //     // dd($bus ,$busupdate);
    //     // return redirect()->back()->with('success', 'Bus modifiée avec succès.');
    //     return redirect()->route('liste.bus', compact("bus", "busupdate"))->with('success', 'Bus modifiée avec succès.');
    // }

    public function update($id)
{
    $busupdate = Bus::findOrFail($id);
    $request = request();

    // Gestion du fichier image
    if ($request->hasFile('photo_bus')) {
        // Chemin du dossier public/buses
        $folder = public_path('buses');

        // Crée le dossier s'il n'existe pas
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Récupère le fichier
        $file = $request->file('photo_bus');

        // Génère un nom unique
        $filename = time() . '_' . $file->getClientOriginalName();

        // Déplace le fichier dans le dossier
        $file->move($folder, $filename);

        // Sauvegarde le chemin relatif pour la base de données
        $busupdate->photo_bus = 'buses/' . $filename;
    }

    // Mise à jour des autres champs
    $busupdate->nom_bus = $request->nom_bus;
    $busupdate->marque_bus = $request->marque_bus;
    $busupdate->modele_bus = $request->modele_bus;
    $busupdate->immatriculation_bus = $request->immatriculation_bus;
    $busupdate->description_bus = $request->description_bus;
    $busupdate->localisation_bus = $request->localisation_bus;
    $busupdate->configuration_place_buses_id = $request->configuration_place_id;

    $busupdate->save();

    return redirect()->route('liste.bus')
        ->with('success', 'Bus modifié avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bus = Bus::find($id);
        $bus->status = 3;
        $bus->save();
        return redirect()->back()->with('success', 'Bus supprimé avec succès.');
    }

        public function destroy_reactivation($id)
    {
        $bus = Bus::find($id);
        $bus->status = 1;
        $bus->save();
        return redirect()->back()->with('success', 'Bus supprimé avec succès.');
    }
}
