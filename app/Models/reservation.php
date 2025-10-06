<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'voyages_id',
        'utilisateurs_id',
        'numero_place',
        'autre_informations',
        'statut', // tu avais "status" dans $fillable mais dans le Blade tu utilises "statut"
        'id_arret_voayage',
        'paiements_id'
    ];

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyages_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateurs_id');
    }

   public function arretvoyage()
    {
    return $this->belongsTo(ArretVoyage::class, 'id_arret_voayage');
    }

        public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'paiements_id');
    }






}
