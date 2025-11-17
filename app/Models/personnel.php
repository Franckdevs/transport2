<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    protected $table = "personnels";
    protected $fillable = [
       'info_user_id',  "nom","prenom","email","telephone","role_utilisateurs_id","adresse","photo","status"
    ];
      public function infoUser()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }

     public function RolePersonnel(){
      return $this->belongsTo(RoleUtilisateur::class,'role_utilisateurs_id');
     }
}
