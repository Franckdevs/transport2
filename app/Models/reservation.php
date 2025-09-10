<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'voyages_id',
        'utilisateurs_id',
        'numero_place',
        'autre_informations',
        'statut', // tu avais "status" dans $fillable mais dans le Blade tu utilises "statut"
    ];

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyages_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateurs_id');
    }
}
