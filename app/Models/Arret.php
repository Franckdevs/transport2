<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arret extends Model
{
    use HasFactory;

    protected $fillable = [
        'itineraire_id',
        'info_user_id',
        'nom',
        'gares_id'
    ];

    // 🔁 Relation : un arrêt appartient à un voyage (Itineraire)
    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class, 'itineraire_id');  // Spécification explicite de la clé étrangère
    }

    // 🔁 Relation : un arrêt appartient à un info_user
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }
    public function voyage()
{
    return $this->belongsTo(Voyage::class);
}

// App\Models\Arret.php
public function arretVoyages()
{
    return $this->hasMany(ArretVoyage::class, 'arret_id');
}

// App\Models\Arret.php
public function gare()
{
    return $this->belongsTo(Gare::class, 'gares_id');
}

public function ville()
{
    return $this->belongsTo(Ville::class, 'ville_id');
}



}
