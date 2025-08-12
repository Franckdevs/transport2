<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jour extends Model
{
    //
    protected $table = 'jours';

    protected $fillable = [
        'nom_jour',
    ];

    public function gares()
    {
        return $this->hasMany(Gare::class, 'jour_id');
    }



}
