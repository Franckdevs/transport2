<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'nom_complet',
        'votre_email',
        'votre_message',
        'is_read',
    ];
}
