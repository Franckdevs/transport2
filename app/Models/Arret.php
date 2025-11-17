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
        'gares_id',
        'ville_id'
    ];

    // 🔁 Relation : un arrêt appartient à un voyage (Itineraire)
    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class, 'itineraire_id');
    }

    // 🔁 Relation : un arrêt appartient à un info_user
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }
    
    // Relation : un arrêt appartient à une gare avec sa ville
    public function gare()
    {
        return $this->belongsTo(Gare::class, 'gares_id')->with('ville');
    }
    
    // Relation : un arrêt appartient à un voyage
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    // Relation : un arrêt a plusieurs arrêts de voyage
    public function arretVoyages()
    {
        return $this->hasMany(ArretVoyage::class, 'arret_id');
    }
    
    // Relation : un arrêt appartient à une ville
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }
}
