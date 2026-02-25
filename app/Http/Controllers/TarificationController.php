<?php

namespace App\Http\Controllers;

use App\Models\TarificationMontantVoyage;
use App\Models\Compagnies;
use App\Models\Classe;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class TarificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $compagnie = $user->info_user->compagnie;
        
    //     // Vérifier si l'utilisateur a une compagnie associée
    //     if (!$compagnie) {
    //         return redirect()->route('compagnie.profile')
    //             ->with('error', 'Vous devez avoir une compagnie associée pour accéder à cette page.');
    //     }
        
    //     $query = TarificationMontantVoyage::with(['classe', 'villeDepart', 'villeArrivee'])
    //         ->where('compagnie_id', $compagnie->id);
            
    //     if ($request->has('search')) {
    //         $search = $request->search;
    //         $query->where(function($q) use ($search) {
    //             $q->whereHas('classe', function($q) use ($search) {
    //                 $q->where('nom', 'like', "%$search%");
    //             })->orWhereHas('villeDepart', function($q) use ($search) {
    //                 $q->where('nom_ville', 'like', "%$search%");
    //             })->orWhereHas('villeArrivee', function($q) use ($search) {
    //                 $q->where('nom_ville', 'like', "%$search%");
    //             });
    //         });
    //     }
        
    //     $tarifications = $query->orderBy('id','desc')->get();
        
    //     return view('compagnie.tarification.index', compact('tarifications'));
    // }

    // In TarificationController.php, update the index method
public function index(Request $request)
{
    $user = Auth::user();
    $compagnie = $user->info_user->compagnie;

    $villes = Ville::where('status', '1')->get();

    $query = TarificationMontantVoyage::with([
        'classe',
        'villeDepart',
        'villeArrivee'
    ])->where('compagnie_id', $compagnie->id);

    if ($request->filled('ville_depart_id')) {
        $query->where('ville_depart_id', $request->ville_depart_id);
    }

    if ($request->filled('ville_arrivee_id')) {
        $query->where('ville_arrivee_id', $request->ville_arrivee_id);
    }

    if ($request->filled('est_actif')) {
        $query->where('est_actif', $request->est_actif);
    }

    $tarifications = $query->orderBy('id', 'desc')->get();
    //dd($tarifications);

    return view('compagnie.tarification.index', compact('tarifications', 'villes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $compagnie = $user->info_user->compagnie;
        
        $classes = Classe::where('est_actif', true)->where('compagnie_id', $compagnie->id)->get();
        $villes = Ville::where('status', '1')->get();
        
        return view('compagnie.tarification.create', compact('classes', 'villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'classe_id' => 'required|exists:classes,id',
        'ville_depart_id' => 'required|exists:villes,id',
        'ville_arrivee_id' => 'required|exists:villes,id',
        'montant' => 'required|numeric|min:0',
        'est_actif' => 'sometimes|boolean'
        ],[
        'classe_id.required'=>'La classe est obligatoire.',
        'classe_id.exists'=>'La classe sélectionnée est invalide.',
        'ville_depart_id.required'  => 'La ville de départ est obligatoire.',
        'ville_depart_id.exists'    => 'La ville de départ sélectionnée est invalide.',
        'ville_arrivee_id.required' => 'La ville d’arrivée est obligatoire.',
        'ville_arrivee_id.exists'   => 'La ville d’arrivée sélectionnée est invalide.',
        'montant.required'          => 'Le montant est obligatoire en FCFA.',
        'montant.numeric'           => 'Le montant doit être un nombre.',
        'montant.min'               => 'Le montant doit être supérieur ou égal à 0.',
        'est_actif.boolean'         => 'Le statut doit être vrai ou faux.'
        ]);

        // Vérification que la ville de départ est différente de la ville d'arrivée
        if ($validated['ville_depart_id'] == $validated['ville_arrivee_id']) {
            return redirect()->back()
                ->with('error', 'La ville de départ et la ville d\'arrivée doivent être différentes.')
                ->withInput();
        }

        // Récupération de l'utilisateur et de sa compagnie
        $user = Auth::user();
        
        // Vérification de l'existence de la relation info_user et compagnie
        if (!$user->info_user || !$user->info_user->compagnie) {
            return redirect()->back()
                ->with('error', 'Aucune compagnie associée à votre compte.')
                ->withInput();
        }
        
        $compagnie = $user->info_user->compagnie;

        // Vérification de l'existence d'une tarification similaire
        $existing = TarificationMontantVoyage::where('compagnie_id', $compagnie->id)
            ->where('classe_id', $validated['classe_id'])
            ->where('ville_depart_id', $validated['ville_depart_id'])
            ->where('ville_arrivee_id', $validated['ville_arrivee_id'])
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Une tarification existe déjà pour cette combinaison de classe, ville de départ et ville d\'arrivée.')
                ->withInput();
        }

        // Création de la nouvelle tarification
        $tarification = new TarificationMontantVoyage();
        $tarification->compagnie_id = $compagnie->id;
        $tarification->classe_id = $validated['classe_id'];
        $tarification->ville_depart_id = $validated['ville_depart_id'];
        $tarification->ville_arrivee_id = $validated['ville_arrivee_id'];
        $tarification->montant = $validated['montant'];
        $tarification->est_actif = $validated['est_actif'] ?? true;
        $tarification->save();

        return redirect()->route('tarification.index')
            ->with('success', 'La tarification a été créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tarification = TarificationMontantVoyage::with(['classe', 'villeDepart', 'villeArrivee'])->findOrFail($id);
        return view('compagnie.tarification.show', compact('tarification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        // Vérification de l'existence de la relation info_user et compagnie
        if (!$user->info_user || !$user->info_user->compagnie) {
            return redirect()->route('tarification.index')
                ->with('error', 'Aucune compagnie associée à votre compte.');
        }
        
        $compagnie = $user->info_user->compagnie;
        $tarification = TarificationMontantVoyage::where('compagnie_id', $compagnie->id)
            ->findOrFail($id);
            
        $classes = Classe::where('est_actif', true)->where('compagnie_id', $compagnie->id)->get();
        $villes = Ville::where('status', '1')->get();
        
        return view('compagnie.tarification.edit', compact('tarification', 'classes', 'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'classe_id' => 'required|exists:classes,id',
            'ville_depart_id' => 'required|exists:villes,id',
            'ville_arrivee_id' => 'required|exists:villes,id|different:ville_depart_id',
            'montant' => 'required|numeric|min:0',
            'est_actif' => 'sometimes|boolean'
        ],[
            'classe_id.required'=>'La classe est obligatoire.',
        'classe_id.exists'=>'La classe sélectionnée est invalide.',
        'ville_depart_id.required'  => 'La ville de départ est obligatoire.',
        'ville_depart_id.exists'    => 'La ville de départ sélectionnée est invalide.',
        'ville_arrivee_id.required' => 'La ville d’arrivée est obligatoire.',
        'ville_arrivee_id.exists'   => 'La ville d’arrivée sélectionnée est invalide.',
        'montant.required'          => 'Le montant est obligatoire en FCFA.',
        'montant.numeric'           => 'Le montant doit être un nombre.',
        'montant.min'               => 'Le montant doit être supérieur ou égal à 0.',
        'est_actif.boolean'         => 'Le statut doit être vrai ou faux.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $tarification = TarificationMontantVoyage::findOrFail($id);
        
        // Vérifier que la tarification appartient bien à la compagnie de l'utilisateur
        if ($tarification->compagnie_id !== $user->info_user->compagnie->id) {
            abort(403, 'Accès non autorisé.');
        }

        // Vérifier si une autre tarification existe déjà pour cette compagnie, cette classe et ces villes
        $existing = TarificationMontantVoyage::where('compagnie_id', $user->info_user->compagnie->id)
            ->where('classe_id', $request->classe_id)
            ->where('ville_depart_id', $request->ville_depart_id)
            ->where('ville_arrivee_id', $request->ville_arrivee_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Une tarification existe déjà pour cette classe et ces villes.')
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $tarification->classe_id = $request->classe_id;
            $tarification->ville_depart_id = $request->ville_depart_id;
            $tarification->ville_arrivee_id = $request->ville_arrivee_id;
            $tarification->montant = $request->montant;
            $tarification->est_actif = $request->has('est_actif');
            
            if (!$tarification->save()) {
                throw new \Exception("Échec de la mise à jour de la tarification.");
            }
            
            DB::commit();
            
            return redirect()->route('tarification.index')
                ->with('success', 'Tarification mise à jour avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de la mise à jour de la tarification : ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de la tarification.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $tarification = TarificationMontantVoyage::findOrFail($id);
        
        // Vérifier que la tarification appartient bien à la compagnie de l'utilisateur
        if ($tarification->compagnie_id !== $user->compagnie->id) {
            abort(403, 'Accès non autorisé.');
        }

        try {
            $tarification->delete();
            return redirect()->route('tarification.index')
                ->with('success', 'Tarification supprimée avec succès.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression de la tarification.');
        }
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus($id)
    {
        $tarification = TarificationMontantVoyage::findOrFail($id);
        $user = Auth::user();
        
        if ($tarification->compagnie_id !== $user->info_user->compagnie->id) {
            abort(403, 'Accès non autorisé.');
        }

        return response()->json([
            'status' => $tarification->est_actif ? 'inactive' : 'active',
            'id' => $tarification->id
        ]);
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'est_actif' => 'required|boolean'
        ]);

        $tarification = TarificationMontantVoyage::findOrFail($id);
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a une compagnie associée
        if (!$user->info_user->compagnie || $tarification->compagnie_id !== $user->info_user->compagnie->id) {
            return response()->json([
                'success' => false,
                'message' => 'Accès non autorisé ou compagnie non trouvée.'
            ], 403);
        }

        try {
            $estActif = (bool)$request->est_actif;
            $tarification->est_actif = $estActif;
            $tarification->save();

            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès',
                'est_actif' => $estActif
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la mise à jour du statut : ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()
            ], 500);
        }
    }
}