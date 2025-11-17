<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    protected $fillable = [
        'user_id',
        'info_user_id',
        'ville_id',
        'estimation',
        'titre',
        'statut',
        'compagnie_id',
        'gare_id',
    ];

    // Relation : un itinéraire appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : un itinéraire appartient à une compagnie (info_user)
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }

    // Relation : un itinéraire a plusieurs arrêts
    public function arrets()
    {
        return $this->hasMany(Arret::class);
    }

    // Récupère les arrêts de voyage à travers la relation avec les voyages
    public function arretVoyages()
    {
        return $this->hasManyThrough(
            ArretVoyage::class,
            Voyage::class,
            'itineraire_id', // Clé étrangère dans la table voyages
            'voyage_id',     // Clé étrangère dans la table arret_voyages
            'id',            // Clé locale dans la table itineraires
            'id'             // Clé locale dans la table voyages
        );
    }

    // Relation : un itinéraire a plusieurs voyages
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
       public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function compagnie()
    {
        return $this->belongsTo(Compagnies::class, 'compagnie_id');
    }

    public function gare()
    {
        return $this->belongsTo(Gare::class, 'gare_id')->with('ville');
    }



}
