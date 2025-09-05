<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class UtilisateurEnAttente extends Authenticatable
{
    use HasApiTokens , HasFactory, Notifiable; // 🔑 Obligatoire pour createToken
    //
    protected $table = 'utilisateur_en_attentes';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'telephone', 'status', 'token'];

    public function otps()
    {
        return $this->hasMany(Otp::class, 'utilisateur_id');
    }
}
