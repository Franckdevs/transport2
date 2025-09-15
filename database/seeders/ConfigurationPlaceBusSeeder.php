<?php

namespace Database\Seeders;

use App\Models\ConfigurationPlaceBus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationPlaceBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configurations = [
            [
                'disposition' => '2-1',
                'nom_complet' => '2 sièges gauche, 1 siège droite',
                'status' => '1',
            ],
            [
                'disposition' => '2-2',
                'nom_complet' => '2 sièges gauche, 2 sièges droite',
                'status' => '1',
            ],
            [
                'disposition' => '3-2',
                'nom_complet' => '3 sièges gauche, 2 sièges droite',
                'status' => '1',
            ],
            [
                'disposition' => '1-1',
                'nom_complet' => '1 siège gauche, 1 siège droite',
                'status' => '1',
            ],
        ];

        foreach ($configurations as $config) {
            ConfigurationPlaceBus::create($config);
        }
    }
}
