<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = "buses";
    protected $fillable = [
        'id',
        'info_user_id',
        'nom_bus',
        'marque_bus',
        'modele_bus',
        'immatriculation_bus',
        'photo_bus',
        'description_bus',
        // 'place',
        'localisation_bus',
        'nombre_places',
        'configuration_car',
        'configuration_place_buses_id',
        'status',
        'compagnies_id',
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

    public function configurationPlace()
    {
        return $this->belongsTo(ConfigurationBus::class, 'configuration_place_buses_id');
    }

    // Relation : un bus a plusieurs places (sièges) via sa configuration
    public function places()
    {
        return $this->hasManyThrough(
            PlaceConfiguration::class,
            ConfigurationBus::class,
            'id', // Foreign key on configuration_buses table
            'configuration_bus_id', // Foreign key on place_configurations table
            'configuration_place_buses_id', // Local key on buses table
            'id' // Local key on configuration_buses table
        );
    }


    public function getPhotoBusAttribute($value)
    {
        if (!$value) {
            return null;
        }
        
        // Si le chemin contient déjà 'http', on le retourne tel quel
        if (strpos($value, 'http') === 0) {
            return $value;
        }
        
        // Nettoyer le chemin pour éviter les doublons
        $cleanPath = ltrim($value, '/');
        $cleanPath = str_replace('buses/', '', $cleanPath);
        
        return asset('buses/' . $cleanPath);
    }




}
