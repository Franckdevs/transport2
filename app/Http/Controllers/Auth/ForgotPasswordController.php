<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\PasswordResetOtpMail;

class ForgotPasswordController extends Controller
{
    /**
     * Affiche le formulaire de demande de réinitialisation de mot de passe
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envoie le lien de réinitialisation par email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Vérifier si l'email existe dans la base de données
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse email.']);
        }

        // Générer et enregistrer l'OTP
        $otpRecord = PasswordResetOtp::generateOtp($request->email);
        
        // Envoyer l'email avec l'OTP (vous devez créer cette vue d'email)
        try {
            Mail::to($request->email)->send(new PasswordResetOtpMail($otpRecord->otp , $user));
            
            // Stocker l'email dans la session pour l'utiliser dans la prochaine étape
            $request->session()->put('password_reset_email', $request->email);
            
            // Rediriger vers la page de vérification OTP
            return redirect()->route('password.verify.otp.form')
                ->with('status', 'Un code de vérification a été envoyé à votre adresse email.');
                
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Une erreur est survenue lors de l\'envoi du code de réinitialisation.']);
        }
    }
    
    /**
     * Affiche le formulaire de vérification OTP
     */
    public function showVerifyOtpForm()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }
        
        return view('auth.verify-otp');
    }
    
    /**
     * Vérifie le code OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);
        
        $email = $request->session()->get('password_reset_email');
        
        if (!PasswordResetOtp::verifyOtp($email, $request->otp)) {
            return back()->withErrors(['otp' => 'Le code de vérification est invalide ou a expiré.']);
        }
        
        // Générer un token pour la réinitialisation
        $token = Str::random(60);
        $request->session()->put('password_reset_token', $token);
        
        return redirect()->route('password.reset', ['token' => $token, 'email' => $email]);
    }

    /**
     * Affiche le formulaire de réinitialisation de mot de passe
     */
    public function showResetForm(Request $request, $token = null)
    {
        // Vérifier si le token de session correspond
        if (!$token || $token !== $request->session()->get('password_reset_token')) {
            return redirect()->route('password.request')
                ->withErrors(['token' => 'Le lien de réinitialisation est invalide ou a expiré.']);
        }
        
        $email = $request->email ?? $request->session()->get('password_reset_email');
        
        return view('auth.reset-password')->with([
            'token' => $token,
            'email' => $email
        ]);
    }

    /**
     * Réinitialise le mot de passe de l'utilisateur
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'token.required' => 'Le token est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être une adresse email valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.password' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.',
        ]); 

        // dd($request->all());

        // Vérifier le token de session
        if ($request->token !== $request->session()->get('password_reset_token')) {
            return redirect()->route('password.request')
                ->withErrors(['token' => 'La session a expiré. Veuillez recommencer.']);
        }

        // Trouver l'utilisateur
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cette adresse email.']);
        }

        // Mettre à jour le mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        // Nettoyer la session
        $request->session()->forget(['password_reset_token', 'password_reset_email']);
        
        // Supprimer les OTP pour cet email
        PasswordResetOtp::where('email', $request->email)->delete();

        // Déclencher l'événement de réinitialisation
        event(new PasswordReset($user));

        return redirect()->route('login')
            ->with('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
    }
}
