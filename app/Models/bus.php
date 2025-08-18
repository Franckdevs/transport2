<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    protected $table = "buses";
    protected $fillable = [
        
            "info_user_id",
            "nom_bus",
            "marque_bus",
            "modele_bus",
            "immatriculation_bus",
            "photo_bus",
            "description_bus",
            "localisation_bus",
            "status",
    ];
public function info_user()
{
    return $this->belongsTo(InfoUser::class, 'info_user_id');
}



}
