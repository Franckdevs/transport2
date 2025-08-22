<?php

namespace App\Http\Controllers;

use App\Models\bus;
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
 */public function store(Request $request)
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
        'configuration_car'    => 'required|string|in:1,2,3,4', // on contrôle les valeurs possibles
    ]);

    // Ajout de l'ID de l'utilisateur relié
    $validated['info_user_id'] = $user->info_user->id;

    // 2. Gestion de la photo
    if ($request->hasFile('photo_bus')) {
        $photoPath = $request->file('photo_bus')->store('buses', 'public');
        $validated['photo_bus'] = $photoPath;
    }

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
        return view("compagnie.bus.show",compact("bus"));
    }

    /**
     *
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $bus = Bus::find($id);
        return view("compagnie.bus.edit",compact("bus"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        $busupdate = Bus::find($id);
        $request = request();
        $busupdate->nom_bus = $request->nom_bus;
        $busupdate->marque_bus = $request->marque_bus;
        $busupdate->modele_bus = $request->modele_bus;
        $busupdate->immatriculation_bus = $request->immatriculation_bus;
        $busupdate->photo_bus = $request->photo_bus;
        $busupdate->description_bus = $request->description_bus;
        $busupdate->localisation_bus = $request->localisation_bus;
        $busupdate->save();
        $bus = Bus::all();
        // return redirect()->back()->with('success', 'Bus modifiée avec succès.');
        return redirect()->route('liste.bus', compact("bus", "busupdate"))->with('success', 'Bus modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bus = Bus::find($id);
        $bus->delete();
        return redirect()->back()->with('success', 'Bus supprimé avec succès.');
    }
}
