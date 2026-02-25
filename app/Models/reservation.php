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
        'status', // tu avais "status" dans $fillable mais dans le Blade tu utilises "statut"
        'id_arret_voayage',
        'agents_id',
        'paiements_id',
        'compagnies_id',
        'gare_id',
        'numero_reservation',
        'nom_complet',
        'telephone_proprietaire'
    
    ];

    public function gares()
    {
        return $this->belongsTo(Gare::class, 'gare_id');
    }

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

    public function arret()
    {
        return $this->belongsTo(Arret::class, 'id_arret_voayage');
    }

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class, 'itineraire_id');
    }





}
