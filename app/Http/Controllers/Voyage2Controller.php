<?php

namespace App\Http\Controllers;

use App\Models\bus;
use App\Models\Itineraire;
use App\Models\Voyage;
use App\Http\Requests\StoreVoyageRequest;
use App\Http\Requests\UpdateVoyageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\InfoUser;
use App\Models\Arret;
use Illuminate\Http\Request;

class Voyage2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $listebus = bus::where('info_user_id', $user->info_user->id)->get();
        return view('compagnie.voyage.index' , compact('listebus'));
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
    public function store(StoreVoyageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Voyage $voyage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voyage $voyage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoyageRequest $request, Voyage $voyage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voyage $voyage)
    {
        //
    }

    public function store_itineraire(Request $request)
{
    // Si c'est du JSON brut, le parser
    if ($request->isJson()) {
        $data = $request->json()->all();
    } else {
        $data = $request->all();
    }

    // Validation
    validator($data, [
        'bus_id' => 'required|exists:bus,id',
        'start_address' => 'required|string',
        'end_address' => 'required|string',
        'distance' => 'required|numeric',
        'duration' => 'required|integer',
        'arrets' => 'nullable|array',
        'arrets.*.adresse' => 'sometimes|required|string',
        'arrets.*.lat' => 'sometimes|required|numeric',
        'arrets.*.lng' => 'sometimes|required|numeric',
    ])->validate();

    // Création
    $itineraire = Itineraire::create([
        'bus_id' => $data['bus_id'],
        'start_address' => $data['start_address'],
        'end_address' => $data['end_address'],
        'distance' => $data['distance'],
        'duration' => $data['duration'],
    ]);

    if (!empty($data['arrets'])) {
        foreach ($data['arrets'] as $arret) {
            $itineraire->arrets()->create($arret);
        }
    }

    // Si AJAX -> JSON, sinon -> redirection
    if ($request->ajax() || $request->isJson()) {
        return response()->json(['success' => true, 'itineraire_id' => $itineraire->id]);
    }

    return redirect()->back()->with('success', 'Itinéraire enregistré avec succès !');
}


}
