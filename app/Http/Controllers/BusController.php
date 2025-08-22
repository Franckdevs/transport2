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
    }

    /**
     *
     * Show the form for editing the specified resource.
     */
    public function edit(bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebusRequest $request, bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bus $bus)
    {
        //
    }
}
