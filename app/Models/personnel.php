<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class personnel extends Model
{
    protected $table = "personnels";
    protected $fillable = [
       'info_user_id',  "nom","prenom","email","telephone","fonction","adresse","photo",
    ];
      public function infoUser()
    {
        return $this->belongsTo(InfoUser::class, 'info_user_id');
    }
}
