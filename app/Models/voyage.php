<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = [
        'itineraire_id',
        'info_user_id',
        'bus_id',
        'chauffeur_id',
        'montant',
        'heure_depart',
        'date_depart',
    ];

    // Relation : un voyage appartient à un itinéraire
    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }

    // Relation : un voyage appartient à un info_user (compagnie)
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }

    // Relation : un voyage a un bus
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    // Relation : un voyage a un chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class, 'chauffeur_id');
    }
}
