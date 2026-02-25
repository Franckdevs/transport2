<?php

namespace Database\Seeders;

use App\Models\Tarification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarificationSeeder extends Seeder
{
    public function run()
    {

        $tarifications = [];
        $now = now();

        for ($i = 0; $i < 100; $i++) {
            // Sélectionner deux villes différentes

            $tarifications[] = [
                'compagnie_id' => 7,
'classe_id' => rand(6, 100),
                'ville_depart_id' => 1,
                'ville_arrivee_id' => 2,
                'montant' => rand(1000, 500000),
                'est_actif' => rand(0, 1),
                'created_at' => $now,
                'updated_at' => $now,
            ];  
        }

        // Insérer les données par lots pour de meilleures performances
        foreach (array_chunk($tarifications, 50) as $chunk) {
            DB::table('tarification_montant_voyages')->insert($chunk);
        }
    }
}