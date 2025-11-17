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
        'villes_id',
        'latitude',
        'longitude',
        'adresse',
        'status',
    ];

public function info_user()
{
    return $this->belongsTo(InfoUser::class, 'info_user_id');

}

public function ville()
{
    return $this->belongsTo(Ville::class, 'villes_id');
}

public function gares()
{
    return $this->hasMany(gare::class, 'compagnie_id');
}
public function voyages()
{
    return $this->hasMany(Voyage::class, 'compagnie_id');
}
public function itineraires()
{
    return $this->hasMany(Itineraire::class, 'compagnie_id');
}

public function getLogoCompagniesAttribute($value)
{
    return $value ? asset('logo_compagnie/' . $value) : null;
}


}
