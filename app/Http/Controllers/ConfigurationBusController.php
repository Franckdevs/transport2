<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\ConfigurationBus;
use App\Models\ConfigurationPlaceBus;
use App\Models\PlaceConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationBusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Récupère toutes les configurations avec leurs sièges
    $user = Auth::user();
    // $bus = Bus::where('info_user_id', $user->info_user->id)->get();
    $configurations = ConfigurationBus::with('placeconfigbussave')
    ->where('compagnie_id', $user->info_user->compagnie->id)
    ->orderBy('id', 'asc')  // Du plus récent (ID le plus élevé) au plus ancien (ID le plus bas)
    ->get();

    // $configurations = $configurations->reverse();
    // dd($configurations);
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
    $user = Auth::user();

    $data = $request->validate([
        'sieges' => 'required|json',
        // 'info_user_id' => 'required|exists:users,id',
        'gare_id' => 'nullable',
        'colonne' => 'required|integer',
        'ranger' => 'required|integer',
        'nom' => 'required|string',
        'places_cote_chauffeur' => 'required|integer',
        'description' => 'nullable|string',
    ], [
        'sieges.required' => 'Veuillez générer la configuration des sièges avant de sauvegarder votre configuration.',
        // 'info_user_id.exists' => 'L\'utilisateur spécifié n\'existe pas.',
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
    $user = Auth::user();   
    $configuration = ConfigurationBus::create([
        'info_user_id' => $user->info_user->id,
        'gare_id' => $data['gare_id'] ?? null,
        'nom' => $data['nom'] ?? null,
        'description' => $data['description'] ?? null,
        'colonne' => $data['colonne'],
        'ranger' => $data['ranger'],
        'places_cote_chauffeur' => $data['places_cote_chauffeur'],
        'compagnie_id' => $user->info_user->compagnie->id,
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
    // $verifier_si_configuration_existe = Bus::where('configuration_place_buses_id',$configuration->id)->first();

$configurationUtilisee = Bus::where(
    'configuration_place_buses_id',
    $configuration->id
)->exists();
    // dd($configurationUtilisee);
    return view('compagnie.Configplace.show', compact('configuration', 'configurationUtilisee'));
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
        try {
            $configuration = ConfigurationBus::findOrFail($id);
            $configuration->update([
                'status' => 1,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Configuration activée avec succès !',
                'status' => 1
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'activation de la configuration: ' . $e->getMessage()
            ], 500);
        }
    }

    public function desactivation($id)
    {
        try {
            $configuration = ConfigurationBus::findOrFail($id);
            $configuration->update([
                'status' => 3,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Configuration désactivée avec succès !',
                'status' => 3
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la désactivation de la configuration: ' . $e->getMessage()
            ], 500);
        }
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
        'nom.required' => 'Veuillez entrer le nom de la configuration.',
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
