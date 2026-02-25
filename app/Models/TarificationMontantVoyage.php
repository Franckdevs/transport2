<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Compagnies;
use App\Models\Itineraire;
use App\Models\Classe;

class TarificationMontantVoyage extends Model
{
    protected $fillable = [
        'id',   
        'compagnie_id',
        'classe_id',
        'ville_depart_id',
        'ville_arrivee_id',
        'montant',
        'est_actif'
    ];

    public function compagnie(): BelongsTo
    {
        return $this->belongsTo(Compagnies::class);
    }

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
    
    /**
     * Relation avec la ville de départ
     */
    public function villeDepart(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_depart_id');
    }
    
    /**
     * Relation avec la ville d'arrivée
     */
    public function villeArrivee(): BelongsTo
    {
        return $this->belongsTo(Ville::class, 'ville_arrivee_id');
    }

    public function arrets()
    {
        return $this->hasMany(Arret::class);
    }

    public function voyage()
    {
        return $this->hasMany(Voyage::class);
    }

    
}
