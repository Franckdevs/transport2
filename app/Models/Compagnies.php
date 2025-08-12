<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compagnies extends Model
{
    protected $table = 'compagnies';

    // Champs autorisés pour l’assignation de masse
    protected $fillable = [
        'nom_complet_compagnies',
        'email_compagnies',
        'telephone_compagnies',
        'adresse_compagnies',
        'description_compagnies',
        'logo_compagnies',
        'info_user_id', // facultatif si tu lies la compagnie à un utilisateur
    ];

public function info_user()
{
    return $this->belongsTo(InfoUser::class, 'info_user_id');
}



}
