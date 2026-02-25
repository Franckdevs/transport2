<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //

    protected $table = "paiements";

    protected $fillable = [
        'utilisateur_id',
        'voyages_id',
        'itineraire_id',
        'numero_place',
        'montant',
        'moyenPaiement',
        'code_paiement',
        'statut',
        'code',
        'nom_usager',
        'prenom_usager',
        'telephone',
        'email',
        'libelle_article',
        'lib_order',
        'Url_Logo',
        'pay_fees',
        'codePaiement',
        'cleretour',
        'datePaiement',
        'HeurePaiement',
        'referencePaiement',
        'benefice',
        'service_id',
        'no_transation',
        'numTel',
        'status',
        'id_arret_voayage',
        'compagnie_id',
        'gares_id',
        'nom_complet',
        'telephone_proprietaire'
    ];

    public function arretvoyage()
    {
        return $this->belongsTo(ArretVoyage::class, 'id_arret_voayage');
    }
    
    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'paiements_id');
    }
    
    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyages_id');
    }
    
    public function compagnie()
    {
        return $this->belongsTo(Compagnies::class, 'compagnie_id');
    }
    
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'paiements_id');
    }



}

