<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'info_user_id',
        'nom_bus',
        'marque_bus',
        'modele_bus',
        'immatriculation_bus',
        'photo_bus',
        'description_bus',
        'place',
        'localisation_bus',
        'nombre_places',
        'configuration_car',
        'status',
    ];

    // Relation : un bus appartient à une compagnie
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class);
    }

    // Relation : un bus a plusieurs voyages
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
