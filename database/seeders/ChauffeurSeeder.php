<?php

namespace Database\Seeders;

use App\Models\Chauffeur;
use Illuminate\Database\Seeder;

class ChauffeurSeeder extends Seeder
{
    /**
     * Exécuter le seeder
     */
    public function run(): void
    {
        // Désactiver les événements du modèle pour améliorer les performances
        Chauffeur::withoutEvents(function () {
            // Créer 10 chauffeurs de test
            Chauffeur::factory()->count(100)->create();
        });

        $this->command->info('10 chauffeurs de test ont été créés avec succès!');
    }
}
