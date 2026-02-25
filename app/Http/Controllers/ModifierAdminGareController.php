<?php

namespace App\Http\Controllers;

use App\Models\gare;
use App\Models\User;
use App\Models\InfoUser;
use App\Models\HistoriqueAdminGare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class ModifierAdminGareController extends Controller
{
    /**
     * Afficher la liste des gares avec leurs administrateurs
     */
    // public function index()
    // {  
    //     $user = Auth::user();
    //     // dd($user);
    //     // $user_gare = $user->info_user->gare;
    //     $user_compagnie = $user->info_user->compagnie;
        
    //     //dd($user_gare , $user_compagnie);

    //     $gares = gare::with('infoUser.user')->get();

    //     return view('compagnie.modifier_admin_gare.index', compact('gares'));
    // }
    public function index()
{  
    $user = Auth::user();

    $compagnieId = $user->info_user->compagnie->id;

    $gares = Gare::with('infoUser.user')
        ->where('compagnie_id', $compagnieId)
        ->get();

    return view('compagnie.modifier_admin_gare.index', compact('gares'));
}


    /**
     * Afficher le formulaire de modification de l'admin d'une gare
     */
    public function edit($gareId)
    {
        $gare = gare::with(['infoUser.user', 'historiqueAdmins'])->findOrFail($gareId);

        $adminActuel = $gare->infoUser?->user;
        
        return view('compagnie.modifier_admin_gare.edit', compact('gare', 'adminActuel'));
    }

    /**
     * Mettre à jour l'administrateur de la gare
     */
    public function update(Request $request, $gareId)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->admin_id,
            'telephone' => 'required|string|max:20',
            'password' => 'nullable|confirmed|min:8',
            'modifier_utilisateur' => 'nullable|boolean',
            'motif_modification' => 'nullable:modifier_utilisateur,1|string|max:500',
        ],[
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'telephone.max' => 'Le numéro de téléphone ne doit pas dépasser 20 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'motif_modification.required_if' => 'Le motif de modification est obligatoire lorsque vous cochez la case d\'historique.',
            'motif_modification.string' => 'Le motif doit être une chaîne de caractères.',
            'motif_modification.max' => 'Le motif ne doit pas dépasser 500 caractères.',
        ]);

        try {
            DB::beginTransaction();

            $gare = gare::findOrFail($gareId);
            $ancienAdmin = $gare->infoUser?->user;
            $utilisateurActuel = Auth::user();

            // Si un admin existe déjà, le mettre à jour
            if ($request->admin_id) {
                $user = User::findOrFail($request->admin_id);
                
                // Sauvegarder les anciennes informations si la checkbox est cochée
                if ($request->modifier_utilisateur) {
                    HistoriqueAdminGare::create([
                        'gare_id' => $gareId,
                        'ancien_admin_id' => $ancienAdmin?->id,
                        'nouvel_admin_id' => $user->id,
                        'ancien_admin_nom' => $ancienAdmin?->nom,
                        'ancien_admin_prenom' => $ancienAdmin?->prenom,
                        'ancien_admin_email' => $ancienAdmin?->email,
                        'ancien_admin_telephone' => $ancienAdmin?->telephone,
                        'nouvel_admin_nom' => $request->nom,
                        'nouvel_admin_prenom' => $request->prenom,
                        'nouvel_admin_email' => $request->email,
                        'nouvel_admin_telephone' => $request->telephone,
                        'motif_modification' => $request->motif_modification,
                        'type_action' => 'modification',
                        'modifie_par_user_id' => $utilisateurActuel?->id,
                        'modifie_par_nom' => $utilisateurActuel?->nom . ' ' . $utilisateurActuel?->prenom,
                    ]);
                }
                
                // Mettre à jour les informations de l'utilisateur
                $user->update([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                ]);

                // Mettre à jour le mot de passe si fourni
                if ($request->filled('password')) {
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);
                }

                // Mettre à jour les informations dans info_user
                if ($user->infoUser) {
                    $user->infoUser->update([
                        'telephone_proprietaire' => $request->telephone,
                        'nom_proprietaire' => $request->nom . ' ' . $request->prenom,
                    ]);
                }

            } else {
                // Créer un nouvel admin
                $user = User::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'password' => Hash::make($request->password ?? 'password123'), // Mot de passe par défaut
                ]);

                // Créer les informations dans info_user
                InfoUser::create([
                    'user_id' => $user->id,
                    'gare_id' => $gareId,
                    'telephone_proprietaire' => $request->telephone,
                    'nom_proprietaire' => $request->nom . ' ' . $request->prenom,
                    'status' => 1,
                ]);

                // Enregistrer dans l'historique comme création
                HistoriqueAdminGare::create([
                    'gare_id' => $gareId,
                    'ancien_admin_id' => null,
                    'nouvel_admin_id' => $user->id,
                    'nouvel_admin_nom' => $request->nom,
                    'nouvel_admin_prenom' => $request->prenom,
                    'nouvel_admin_email' => $request->email,
                    'nouvel_admin_telephone' => $request->telephone,
                    'motif_modification' => 'Création d\'un nouvel administrateur',
                    'type_action' => 'creation',
                    'modifie_par_user_id' => $utilisateurActuel?->id,
                    'modifie_par_nom' => $utilisateurActuel?->nom . ' ' . $utilisateurActuel?->prenom,
                ]);
            }

            DB::commit();

            return redirect()->route('modifier_admin_gare.index')
                ->with('success', 'Administrateur de la gare mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Supprimer l'administrateur d'une gare
     */
    public function destroy($gareId, $adminId)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($adminId);
            
            // Supprimer les info_user associés
            if ($user->infoUser) {
                $user->infoUser->delete();
            }
            
            // Supprimer l'utilisateur
            $user->delete();

            DB::commit();

            return redirect()->route('modifier_admin_gare.index')
                ->with('success', 'Administrateur de la gare supprimé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Désactiver un administrateur de gare
     */
    public function deactivate($gareId, $adminId)
    {
        try {
            $user = User::findOrFail($adminId);
            $user->update(['status' => 0]);

            return redirect()->route('modifier_admin_gare.index')
                ->with('success', 'Administrateur de la gare désactivé avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la désactivation: ' . $e->getMessage());
        }
    }

    /**
     * Activer un administrateur de gare
     */
    public function activate($gareId, $adminId)
    {
        try {
            $user = User::findOrFail($adminId);
            $user->update(['status' => 1]);

            return redirect()->route('modifier_admin_gare.index')
                ->with('success', 'Administrateur de la gare activé avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'activation: ' . $e->getMessage());
        }
    }
}
