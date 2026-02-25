<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueAdminGare extends Model
{
    protected $table = 'historique_admin_gare';
    
    protected $fillable = [
        'gare_id',
        'ancien_admin_id',
        'nouvel_admin_id',
        'ancien_admin_nom',
        'ancien_admin_prenom',
        'ancien_admin_email',
        'ancien_admin_telephone',
        'nouvel_admin_nom',
        'nouvel_admin_prenom',
        'nouvel_admin_email',
        'nouvel_admin_telephone',
        'motif_modification',
        'type_action',
        'date_modification',
        'modifie_par_user_id',
        'modifie_par_nom',
    ];

    protected $casts = [
        'date_modification' => 'datetime',
    ];

    public function gare(): BelongsTo
    {
        return $this->belongsTo(gare::class, 'gare_id');
    }

    public function ancienAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ancien_admin_id');
    }

    public function nouvelAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nouvel_admin_id');
    }

    public function modifiePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modifie_par_user_id');
    }

    /**
     * Scope pour récupérer l'historique le plus récent d'abord
     */
    public function scopePlusRecent($query)
    {
        return $query->orderBy('date_modification', 'desc');
    }

    /**
     * Scope pour filtrer par type d'action
     */
    public function scopeParTypeAction($query, $typeAction)
    {
        return $query->where('type_action', $typeAction);
    }
}
