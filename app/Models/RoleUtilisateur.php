<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUtilisateur extends Model
{
    protected $table = "role_utilisateurs";

    protected $fillable = [
        "nom_role",
        "description",
        "status"
    ];

    // Un rôle a plusieurs utilisateurs
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'role_utilisateurs_id', 'id');
    }
}
