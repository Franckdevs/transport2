<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TarificationMontantVoyage;

class Classe extends Model
{
    protected $fillable = [
        'id',
        'nom',
        'compagnie_id',
        'description',
        'est_actif'
    ];

    protected $casts = [
        'est_actif' => 'boolean'
    ];

    public function tarifications(): HasMany
    {
        return $this->hasMany(TarificationMontantVoyage::class);
    }

    /**
     * Bascule le statut actif/inactif de la classe
     *
     * @return bool
     */
  public function toggleStatus(): string
{
    // Inverse le statut
    $this->est_actif = !$this->est_actif;

    // Sauvegarde et retourne le message correspondant
    if ($this->save()) {
        return $this->est_actif ? 'Actif' : 'Inactif';
    }

    // En cas d’échec de sauvegarde
    return 'Erreur';
}
}
