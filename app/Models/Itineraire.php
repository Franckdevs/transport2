<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    //
     protected $fillable = ['bus_id', 'start_address', 'end_address', 'distance', 'duration'];

    public function arrets()
    {
        return $this->hasMany(Arret::class);
    }
}
