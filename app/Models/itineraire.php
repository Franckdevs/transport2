<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    protected $fillable = [
        'user_id',
        'info_user_id',
        'vdepart',
        'estimation',
        'titre',
        'statut',
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

    // Relation : un itinéraire a plusieurs voyages
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
