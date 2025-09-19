<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArretVoyage extends Model
{
    // Nom explicite de la table si différent de la convention Laravel
    protected $table = "arret_voyages";

    // Colonnes pouvant être assignées en masse
    protected $fillable = [
        "voyage_id",
        "arret_id",
        "montant",
    ];

    // Relations (optionnel, mais pratique)
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    public function arret()
    {
        return $this->belongsTo(Arret::class);
    }
}
