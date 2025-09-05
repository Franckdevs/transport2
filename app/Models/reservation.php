<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    //

    protected $table = 'reservations';

    protected $fillable = [
        'voyages_id',
        'utilisateurs_id',
        'numero_place',
        'autre_informations',
        'status',
    ];

    public function voyage()
    {
        return $this->belongsTo(voyage::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class);
    }


}
