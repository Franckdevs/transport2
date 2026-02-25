<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    public function run(): void
    {
        // Types de classes de base
        $typesClasses = [
            'Économique', 'Affaires', 'Première', 'VIP', 'Standard', 'Confort',
            'Luxe', 'Exécutive', 'Familiale', 'Étudiant', 'Sénior', 'Enfant'
        ];

        // Adjectifs pour les descriptions
        $adjectifs = [
            'confortable', 'spacieux', 'moderne', 'élégant', 'luxueux', 'pratique',
            'économique', 'exclusif', 'haut de gamme', 'premium', 'standard', 'basique'
        ];

        // Services optionnels
        $services = [
            'sièges inclinables', 'repas inclus', 'wifi gratuit', 'prise électrique',
            'espace jambes supplémentaire', 'écran individuel', 'service à bord',
            'couverture et oreiller', 'collation offerte', 'journal gratuit'
        ];

        // Nombre d'enregistrements à créer
        $nombreEnregistrements = 150;

        // ID des compagnies disponibles (à adapter selon votre base de données)
        $compagniesIds = range(1, 10);

        for ($i = 1; $i <= $nombreEnregistrements; $i++) {
            // Sélection aléatoire des éléments
            $type = $typesClasses[array_rand($typesClasses)];
            $adjectif = $adjectifs[array_rand($adjectifs)];
            $service1 = $services[array_rand($services)];
            $service2 = $services[array_rand($services)];
            
            // Création du nom et de la description
            $nom = 'Classe ' . $type . ' ' . ($i % 5 + 1);
            $description = 'Classe ' . $adjectif . ' avec ' . $service1 . ' et ' . $service2 . '.';
            
            // Valeurs aléatoires
            $estActif = (bool)rand(0, 1);
            $compagnieId = $compagniesIds[array_rand($compagniesIds)];

            Classe::create([
                'nom' => $nom,
                'description' => $description,
                'est_actif' => $estActif,
                'compagnie_id' => null, // Temporairement null jusqu'à ce que les compagnies soient créées
                'created_at' => now()->subDays(rand(0, 365)),
                'updated_at' => now(),
            ]);
        }
    }
}
