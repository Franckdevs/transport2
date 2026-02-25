<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetOtp extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at'];
    public $timestamps = false;

    /**
     * Génère un nouveau code OTP
     */
    public static function generateOtp($email)
    {
        // Supprimer les anciens OTP pour cet email
        self::where('email', $email)->delete();

        // Créer un nouveau OTP (6 chiffres)
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(30); // Expire après 30 minutes

        return self::create([
            'email' => $email,
            'otp' => $otp, // Stocker en clair
            'expires_at' => $expiresAt
        ]);
    }

    /**
     * Vérifie si le code OTP est valide
     */
    public static function verifyOtp($email, $otp)
    {
        $otpRecord = self::where('email', $email)
            ->where('otp', $otp) // Vérification directe
            ->where('expires_at', '>', now())
            ->first();

        return $otpRecord !== null;
    }
}
