<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',   
        'nom',
        'prenom',
        'email',
        'password',
        'status',
        'token',
        'compagnie_id',
        'gare_id',
        'role_personnel'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function compagnie()
    {
        return $this->belongsTo(Compagnies::class, 'compagnie_id');
    }

    public function gares()
    {
        return $this->belongsTo(gare::class, 'gare_id');
    }

}
