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

public function user()
{
    return $this->belongsTo(User::class);
}

public function compagnie()
{
    return $this->hasOne(Compagnies::class, 'info_user_id'); // ✅ sans espace
}

public function gare()
{
    return $this->hasOne(Gare::class, 'info_user_id');
}





}
