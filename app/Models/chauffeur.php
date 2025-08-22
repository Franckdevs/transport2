<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chauffeur extends Model
{
    protected $fillable = [
        'info_user_id',
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'numeros_permis',
        'date_naissance',
        'status',
        'photo',
    ];

    // Relation : un chauffeur appartient à une compagnie
    public function info_user()
    {
        return $this->belongsTo(InfoUser::class);
    }

    // Relation : un chauffeur a plusieurs voyages
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
