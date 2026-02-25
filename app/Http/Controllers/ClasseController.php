<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClasseController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->info_user || !$user->info_user->compagnie) {
            return redirect()->route('dashboard')->with('error', 'Aucune compagnie associée à votre compte.');
        }

        $classes = Classe::where('compagnie_id', $user->info_user->compagnie->id)
            // ->orderBy('nom')
            // ->get();
               ->orderBy('id', 'desc')
    ->get();

        return view('compagnie.classe.index', compact('classes'));
    }

    public function create()
    {
        return view('compagnie.classe.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'est_actif' => 'boolean'
        ],[
            'nom.required' => 'Le nom de la classe est requis',
            'nom.max' => 'Le nom de la classe ne peut pas dépasser 255 caractères',
            'est_actif.boolean' => 'L\'état de la classe doit être un actif ou inactif',
        ]);

        $user = Auth::user();
        
        if (!$user->info_user || !$user->info_user->compagnie) {
            return redirect()->back()
                ->with('error', 'Aucune compagnie associée à votre compte.')
                ->withInput();
        }

        $validated['compagnie_id'] = $user->info_user->compagnie->id;
        $validated['nom'] = $request->nom;
        $validated['description'] = $request->description;
        $validated['est_actif'] = $request->has('est_actif');
      
        Classe::create($validated);

        return redirect()->route('classe.index')
            ->with('success', 'La classe a été créée avec succès.');
    }

    public function show(Classe $classe)
    {
        $this->authorize('view', $classe);
        return view('compagnie.classe.show', compact('classe'));
    }

    public function edit(Classe $classe)
    {
        $this->authorize('update', $classe);
        return view('compagnie.classe.edit', compact('classe'));
    }

    public function update(Request $request, Classe $classe)
    {
        $this->authorize('update', $classe);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'est_actif' => 'boolean'
        ],[
            'nom.required' => 'Le nom de la classe est requis',
            'nom.max' => 'Le nom de la classe ne peut pas dépasser 255 caractères',
            'est_actif.boolean' => 'L\'état de la classe doit être un actif ou inactif',
        ]);

        $validated['est_actif'] = $request->has('est_actif');
        $classe->update($validated);

        return redirect()->route('classe.index')
            ->with('success', 'La classe a été mise à jour avec succès.');
    }

    public function destroy(Classe $classe)
    {
        $this->authorize('delete', $classe);
        
        try {
            $classe->delete();
            return response()->json([
                'success' => true,
                'message' => 'Classe supprimée avec succès.'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la classe : ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer cette classe car elle est utilisée dans des tarifications.'
            ], 422);
        }
    }

    /**
     * Bascule le statut actif/inactif d'une classe
     *
     * @param  \App\Models\Classe  $classe
     * @return \Illuminate\Http\JsonResponse
     */
 public function toggleStatus($id)
{
    try {
        $classe = Classe::findOrFail($id);
        $this->authorize('update', $classe);

        // Toggle et récupérer le message
        $message = $classe->toggleStatus();

        return redirect()->back()
            ->with('success', 'Le statut de la classe a été mis à jour : ' . $message);
    } catch (\Exception $e) {
        Log::error('Erreur lors du changement de statut de la classe : ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Erreur : ' . $e->getMessage());
    }
}


    public function updateStatus(Request $request, Classe $classe)
    {
        $this->authorize('update', $classe);
        
        $request->validate([
            'est_actif' => 'required|boolean'
        ]);

        $classe->update(['est_actif' => $request->est_actif]);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès',
            'est_actif' => $classe->est_actif
        ]);
    }
}
