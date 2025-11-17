<?php

namespace App\Http\Controllers;

use App\Models\ConfigurationBus;
use App\Models\ConfigurationPlaceBus;
use App\Models\PlaceConfiguration;
use Illuminate\Http\Request;

class ConfigurationBusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Récupère toutes les configurations avec leurs sièges
    $configurations = ConfigurationBus::with('placeconfigbussave')->get();

    // Passe les données à la vue
    return view('compagnie.Configplace.index', compact('configurations'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('compagnie.Configplace.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(Request $request)
{
    $data = $request->validate([
        'sieges' => 'required|json',
        'info_user_id' => 'required|exists:users,id',
        'gare_id' => 'nullable',
        'colonne' => 'required|integer',
        'ranger' => 'required|integer',
        'nom' => 'required|string',
        'places_cote_chauffeur' => 'required|integer',
        'description' => 'nullable|string',
    ], [
        'sieges.required' => 'Veuillez sélectionner au moins un siège.',
        'info_user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',
        'colonne.required' => 'Veuillez entrer le nombre de colonnes.',
        'colonne.integer' => 'Le nombre de colonnes doit être un entier.',
        'ranger.required' => 'Veuillez entrer le nombre de rangées.',
        'ranger.integer' => 'Le nombre de rangées doit être un entier.',
    ]);

    $sieges = json_decode($data['sieges'], true);
//   dd($sieges);
    // Supprimer l'ancienne configuration du même utilisateur si nécessaire
    // ConfigurationBus::where('info_user_id', $data['info_user_id'])->delete();

    // Crée la configuration globale du bus
    $configuration = ConfigurationBus::create([
        'info_user_id' => $data['info_user_id'],
        'gare_id' => $data['gare_id'] ?? null,
        'nom' => $data['nom'] ?? null,
        'description' => $data['description'] ?? null,
        'colonne' => $data['colonne'],
        'ranger' => $data['ranger'],
        'places_cote_chauffeur' => $data['places_cote_chauffeur'],
        'status'=> 1,
    ]);
    // Crée les sièges associés
    foreach ($sieges as $seat) {
        PlaceConfiguration::create([
            'configuration_bus_id' => $configuration->id,
            'numero' => $seat['numero'],
            'disponible' => $seat['disponible'],
            'type' => $seat['type'],
            'nom'=>$seat['nom'],
        ]);
    }
    
    // dd($configuration);
    return redirect()->route('listeconfig.index')->with('success', 'Configuration du bus sauvegardée avec succès !');
}

public function show_vrai($id)
{
    // Récupère la configuration avec ses places
    $configuration = ConfigurationBus::with('placeconfigbussave')->findOrFail($id);
// dd($configuration);
    return view('compagnie.Configplace.show', compact('configuration'));
}



    /**
     * Display the specified resource.
     */
    public function show(ConfigurationBus $configurationBus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(ConfigurationBus $configurationBus)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, ConfigurationBus $configurationBus)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfigurationBus $configurationBus)
    {
        //
    }

    //ecrir deux function activation et desactivation du status des configurations
    public function activation($id)
    {
        $configuration = ConfigurationBus::findOrFail($id);
        $configuration->update([
            'status' => 1,
        ]);
        return redirect()->route('listeconfig.index')->with('success', 'Configuration activée avec succès !');
    }

    public function desactivation($id)
    {
        $configuration = ConfigurationBus::findOrFail($id);
        $configuration->update([
            'status' => 3,
        ]);
        return redirect()->route('listeconfig.index')->with('success', 'Configuration desactivée avec succès !');
    }


    public function edit($id)
{
    $configuration = ConfigurationBus::with('placeconfigbussave')->findOrFail($id);
    return view('compagnie.Configplace.edit', compact('configuration'));
}


public function update(Request $request, $id)
{
    // On récupère la configuration existante
    $configuration = ConfigurationBus::findOrFail($id);
    // ✅ Validation cohérente avec celle de "store"
    $validated = $request->validate([
        'sieges' => 'required|json',
        'info_user_id' => 'required|exists:users,id',
        'gare_id' => 'nullable',
        'colonne' => 'required|integer',
        'ranger' => 'required|integer',
        'nom' => 'required|string',
        'places_cote_chauffeur' => 'required|integer',
        'description' => 'nullable|string',
    ], [
        'sieges.required' => 'Veuillez sélectionner au moins un siège.',
        'info_user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',
        'colonne.required' => 'Veuillez entrer le nombre de colonnes.',
        'colonne.integer' => 'Le nombre de colonnes doit être un entier.',
        'ranger.required' => 'Veuillez entrer le nombre de rangées.',
        'ranger.integer' => 'Le nombre de rangées doit être un entier.',
    ]);

    // ✅ Décodage du JSON des sièges
    $sieges = json_decode($validated['sieges'], true);

    // ✅ Mise à jour des champs principaux de la configuration
    $configuration->update([
        'info_user_id' => $validated['info_user_id'],
        'gare_id' => $validated['gare_id'] ?? null,
        'nom' => $validated['nom'],
        'description' => $validated['description'] ?? null,
        'colonne' => $validated['colonne'],
        'ranger' => $validated['ranger'],
        'places_cote_chauffeur' => $validated['places_cote_chauffeur'],
    ]);

    // ✅ Suppression des anciens sièges liés à cette configuration
    PlaceConfiguration::where('configuration_bus_id', $configuration->id)->delete();

    // ✅ Réinsertion des nouveaux sièges
    foreach ($sieges as $seat) {
        PlaceConfiguration::create([
            'configuration_bus_id' => $configuration->id,
            'numero' => $seat['numero'],
            'disponible' => $seat['disponible'],
            'type' => $seat['type'],
            'nom' => $seat['nom'],
        ]);
    }
    // ✅ Redirection avec message de succès
    return redirect()
        ->route('listeconfig.index')
        ->with('success', 'Configuration du bus mise à jour avec succès !');
}

    
}
