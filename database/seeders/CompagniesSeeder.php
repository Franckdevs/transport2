<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\InfoUser;
use App\Models\Compagnies;
use App\Models\Ville;

class CompagniesSeeder extends Seeder
{
    public function run(): void
    {
        $villes = Ville::pluck('id')->toArray();

        if (empty($villes)) {
            $this->command->warn("⚠️ Aucune ville trouvée. Ajoute d’abord des villes dans la table `villes`.");
            return;
        }

        for ($i = 1; $i <= 100; $i++) {
            // 🔹 Générer des données fictives
            $nom = "Nom{$i}";
            $prenom = "Prenom{$i}";
            $email = "user{$i}@test.com";
            $telephone = "01000000{$i}";

            // 🔹 Créer User
            $user = User::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $telephone,
                'email' => $email,
                'password' => Hash::make('password'), // mot de passe par défaut
            ]);

            // 🔹 Créer InfoUser
            $infoUser = InfoUser::create([
                'user_id' => $user->id,
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $telephone,
                'email' => $email,
                'password' => $user->password,
            ]);

            // 🔹 Assigner rôle & permission
            $user->assignRole('super-admin-compagnie');
            $user->givePermissionTo('tout-les-permissions');

            // 🔹 Créer Compagnie
            Compagnies::create([
                'nom_complet_compagnies' => "Compagnie {$i}",
                'email_compagnies' => "compagnie{$i}@test.com",
                'telephone_compagnies' => "02000000{$i}",
                'adresse_compagnies' => "Adresse Compagnie {$i}",
                'description_compagnies' => "Description de la compagnie {$i}",
                'logo_compagnies' => null,
                'info_user_id' => $infoUser->id,
                'latitude' => rand(-90, 90) . '.' . rand(100000, 999999),
                'longitude' => rand(-180, 180) . '.' . rand(100000, 999999),
                'adresse' => "Rue {$i}, Quartier Test",
                'villes_id' => $villes[array_rand($villes)], // choisir une ville aléatoire
            ]);
        }

        $this->command->info("✅ 100 compagnies ont été créées avec succès !");
    }
}
