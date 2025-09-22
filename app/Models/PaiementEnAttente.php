<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaiementEnAttente extends Model
{
    protected $table = "paiement_en_attentes";

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
        'id_arret_voayage'
    ];

    
}
