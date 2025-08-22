<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arret extends Model
{
    //
     protected $fillable = ['itineraire_id', 'adresse', 'lat', 'lng'];

    public function itineraire()
    {
        return $this->belongsTo(Itineraire::class);
    }
}
