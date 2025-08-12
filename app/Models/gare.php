<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gare extends Model
{
    //

    protected $table = 'gares';
    protected $fillable = [
        'info_user_id',
        'jour_id',
        'ville_id',
        'jour_ouvert_id',
        'jour_de_fermeture_id',
        'latitude',
        'longitude',
        'heure_ouverture',
        'heure_fermeture',
        'nombre_quais',
        'parking_disponible',
        'wifi_disponible',
        'telephone',
        'email',
        'site_web',
        'description',
        'nom_gare',
        'adresse_gare',
        'telephone_gare'
    ];

    // Relations
    public function infoUser()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }

    public function jour()
    {
        return $this->belongsTo(Jour::class, 'jour_id');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function jourOuvert()
    {
        return $this->belongsTo(Jour::class, 'jour_ouvert_id');
    }

    public function jourFermeture()
    {
        return $this->belongsTo(Jour::class, 'jour_de_fermeture_id');
    }
}
