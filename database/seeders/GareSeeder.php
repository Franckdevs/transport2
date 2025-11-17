<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gare;
use App\Models\Compagnies;
use App\Models\Ville;
use App\Models\Jour;

class GareSeeder extends Seeder
{
    public function run()
    {
        $compagnie = Compagnies::first();
        $ville = Ville::first();
        $jourOuvert = Jour::first();
        $jourFermeture = Jour::skip(1)->first();

        Gare::create([
            'info_user_id' => 1,
            'jour_id' => 1,
            'telephone' => '0987654321',
            'admin_nom' => 'Admin Gare',
            'admin_prenom' => 'Gare',
            'admin_email' => '5mOw0@example.com',
            'admin_telephone' => '0987654321',
            'nom_gare' => 'Gare Centrale',
            'adresse_gare' => '456 Avenue du Voyage',
            'telephone_gare' => '0987654321',
            'email' => '1adickofranck@gmail.com',
            'site_web' => 'https://gare-centrale.example.com',
            'description' => 'Gare principale de la ville.',
            'latitude' => '5.3456',
            'longitude' => '-4.0123',
            'parking_disponible' => true,
            'wifi_disponible' => true,
            'heure_ouverture' => '06:00:00',
            'heure_fermeture' => '23:00:00',
            'ville_id' => $ville ? $ville->id : null,
            'jour_ouvert_id' => $jourOuvert ? $jourOuvert->id : null,
            'jour_de_fermeture_id' => $jourFermeture ? $jourFermeture->id : null,
            'compagnie_id' => $compagnie ? $compagnie->id : null,
        ]);
    }
}
