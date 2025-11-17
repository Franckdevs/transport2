<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceConfiguration extends Model
{
    protected $fillable = [
        'configuration_bus_id',
        'numero',
        'disponible',
        'type',
        'nom'
    ];

    public function configuration()
    {
        return $this->belongsTo(ConfigurationBus::class, 'configuration_bus_id');
    }
}
