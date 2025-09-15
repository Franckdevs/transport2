<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationPlaceBus extends Model
{
    protected $table = "configuration_place_buses";

    protected $fillable = [
        "disposition",
        "nom_complet",
        "status"
    ];

    // Relation : une configuration peut être utilisée par un bus
   public function bus()
{
    return $this->hasOne(Bus::class, 'configuration_place_buses_id');
}

}
