<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Model
{
    //
    use HasApiTokens , HasFactory, Notifiable; // 🔑 Obligatoire pour createToken
    protected $table = 'utilisateurs';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'telephone', 'status', 'token'];

    public function otps()
    {
        return $this->hasMany(Otp::class, 'utilisateur_id');
    }

    



}
