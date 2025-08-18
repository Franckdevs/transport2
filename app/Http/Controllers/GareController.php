<?php

namespace App\Http\Controllers;

use App\Models\gare;
use App\Http\Requests\StoregareRequest;
use App\Http\Requests\UpdategareRequest;
use App\Models\InfoUser;
use App\Models\Jour;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoregareRequest $request)
    {
        //
    }
public function store2(Request $request)
{
        $user = Auth::user();
    // 1️⃣ Validation
    $validated = $request->validate([
        'nom_gare' => 'nullable',
        'adresse_gare'=> 'nullable',
        'telephone_gare'=> 'nullable',
        'ville_id'=> 'nullable|exists:villes,id',
        'jour_id'=> 'nullable|exists:jours,id',
        'jour_ouvert_id'=> 'nullable|exists:jours,id',
        'jour_de_fermeture_id'=> 'nullable|exists:jours,id',
        'nombre_quais'=> 'nullable',
        'latitude'=> 'nullable',
        'longitude'=> 'nullable',
        'heure_ouverture'=> 'nullable',
        'heure_fermeture'=> 'nullable',
        'parking_disponible'=> 'boolean',
        'wifi_disponible'=> 'boolean',
        'telephone'=> 'nullable',
        'email'=> 'nullable|email',
        'site_web'=> 'nullable',
        'description'=> 'nullable',
    ]);
    // 2️⃣ On ajoute l'info_user_id après validation
    $validated['info_user_id'] = $user->info_user->id;

    // dd($validated);

    // 3️⃣ Création de la gare
    Gare::create($validated);

    return redirect()->route('gares.index')
        ->with('success', 'Gare créée avec succès ✅');
}


    /**
     * Display the specified resource.
     */
    public function show(gare $gare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gare $gare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategareRequest $request, gare $gare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gare $gare)
    {
        //
    }

public function index2()
{
    $listegares = gare::orderBy('id', 'desc')->get();
    return view('compagnie.gares.index', compact('listegares'));
}

public function create2()
{
   return view('compagnie.gares.create', [
        'infoUsers' => InfoUser::all(),
        'jours' => Jour::all(),
        'villes' => Ville::all(),
    ]);
}

public function ajouterbUS(gare $gare)
{
    $gares = gare::where('id', $gare->id);
    // dd($gares );
    return view('compagnie.gares.bus', compact('gares'));
}

}
