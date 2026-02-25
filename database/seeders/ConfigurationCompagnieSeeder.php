<?php

namespace Database\Seeders;

use App\Models\Configuration;
use App\Models\ConfigurationBus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationCompagnieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les contraintes de clé étrangère
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // // Vider la table avant de la remplir
        // Configuration::truncate();

        $nomsConfigurations = [
            'Standard', 'VIP', 'Économique', 'Confort', 'Affaires',
            'Première Classe', 'Luxe', 'Familiale', 'Groupe', 'Spéciale'
        ];

        for ($i = 0; $i < 100; $i++) {
            $colonne = rand(2, 5);
            $ranger = rand(5, 15);
            
            ConfigurationBus::create([
                'compagnie_id' => 7,
                'info_user_id' => 10,
                'gare_id' => null,
                'nom' => 'Configuration ' . $nomsConfigurations[$i % count($nomsConfigurations)] . ' ' . ($i + 1),
                'description' => sprintf(
                    'Configuration %s avec %d colonnes et %d rangées',
                    strtolower($nomsConfigurations[$i % count($nomsConfigurations)]),
                    $colonne,
                    $ranger
                ),
                'colonne' => $colonne,
                'ranger' => $ranger,
                'places_cote_chauffeur' => rand(0, 1),
                'status' => [1, 1, 1, 3][rand(0, 3)], // 75% de chance d'être actif (1), 25% inactif (3)
                'created_at' => now()->subDays(rand(0, 90))->subHours(rand(0, 23)),
                'updated_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
