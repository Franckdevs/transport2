<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'code_otps';

    protected $fillable = [
        'utilisateur_id',
        'code',
        'status',
    ];

    /**
     * Relation avec l'utilisateur en attente
     */
    public function utilisateurEnAttente()
    {
        return $this->belongsTo(UtilisateurEnAttente::class, 'utilisateur_id');
    }
}
