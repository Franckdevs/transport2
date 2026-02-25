<?php

namespace Database\Seeders;

use App\Models\ConfigurationPlaceBus;
use App\Models\User;
use App\Models\Ville;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Exécuter les seeders dans l'ordre correct
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            // UtilisateurSeeder::class, // Ajout du UtilisateurSeeder après RoleSeeder
            JourSeeder::class,
            VilleSeeder::class,
            SuperAdminBetroSeeder::class,
            // ConfigurationPlaceBusSeeder::class, // ✅ ici
            RoleUtilisateurSeeder::class,
            // CompagniesSeeder::class,
            // GareSeeder::class,
            ClasseSeeder::class,
            UtilisateurSeeder::class,
            ]);
    }
}
