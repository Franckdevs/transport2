<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    //
    protected $table = 'info_users';
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'user_id',
    ];
}
