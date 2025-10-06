<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminGareSetupController extends Controller
{
    /**
     * Afficher la page de configuration du mot de passe
     */
    public function showSetupForm(Request $request, User $user)
    {
        // Vérifier que le lien signé est valide
        if (!$request->hasValidSignature()) {
            abort(403, 'Ce lien a expiré ou n\'est pas valide.');
        }

        // Vérifier si la personne a déjà un mot de passe renseigné
        if (!empty($user->password)) {
            return redirect()->route('login');
        }

        // Récupérer les informations de la gare associée à l'utilisateur
        $gare = null;
        if ($user->info_user && $user->info_user->gares) {
            $gare = $user->info_user->gares->first();
        }

        return view('auth.admin-gare-setup', compact('user', 'gare'));
    }

    /**
     * Traiter la configuration du mot de passe
     */
    public function setupPassword(Request $request, User $user)
    {
        // Validation
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mettre à jour le mot de passe
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Connecter automatiquement l'utilisateur
        Auth::login($user);

        // Rediriger selon le rôle de l'utilisateur
        if ($user->hasRole('super-admin-gare')) {
            return redirect()->route('dashboardcompagnie_name')
                ->with('success', 'Bienvenue ! Votre compte administrateur de gare a été configuré avec succès. 🎉');
        }
        
        return redirect()->route('dashboard')
            ->with('success', 'Bienvenue ! Votre compte a été configuré avec succès. 🎉');
    }

    
}
