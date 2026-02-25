<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigWebMobile extends Model
{
    protected $table = 'config_web_mobiles';

    protected $fillable = [
        'image_acceuil_mobile',
        'sous_image_acceuil_mobile',
        'image_acceuil_web',
        'sous_image_acceuil_web',
        'image_connexion_web',
        'status',
    ];

    // Accessors pour les chemins des images
    public function getImageAcceuilMobileAttribute($value)
    {
        return $value ? asset('config_web_mobile/' . $value) : null;
    }

    public function getSousImageAcceuilMobileAttribute($value)
    {
        return $value ? asset('config_web_mobile/' . $value) : null;
    }

    public function getImageAcceuilWebAttribute($value)
    {
        return $value ? asset('config_web_mobile/' . $value) : null;
    }

    public function getSousImageAcceuilWebAttribute($value)
    {
        return $value ? asset('config_web_mobile/' . $value) : null;
    }

    public function getImageConnexionWebAttribute($value)
    {
        return $value ? asset('config_web_mobile/' . $value) : null;
    }
}
