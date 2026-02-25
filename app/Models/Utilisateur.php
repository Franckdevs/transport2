<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Utilisateur extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; // 🔑 Obligatoire pour createToken
    
    protected $table = 'utilisateurs';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'telephone', 'status', 'token'];
    
    // Spécifier le garde par défaut pour ce modèle
    protected $guard_name = 'api';

    public function otps()
    {
        return $this->hasMany(Otp::class, 'utilisateur_id');
    }

    



}
