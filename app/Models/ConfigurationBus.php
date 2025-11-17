<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationBus extends Model
{
    //
        protected $fillable = [
            'info_user_id',
            'gare_id',
            'nom',
            'colonne',
            'ranger',
            'description',
            'status',
            'places_cote_chauffeur'
        ];

     public function placeconfigbussave()
    {
        return $this->hasMany(PlaceConfiguration::class, 'configuration_bus_id');
    }

}
