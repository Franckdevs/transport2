<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\InfoUser; // ✅ Ajout de l'import du modèle InfoUser

class SuperAdminBetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création ou récupération de l'utilisateur super-admin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@betro.com'],
            [
                'nom' => 'Super',
                'prenom' => 'Admin Betro',
                'telephone' => '0101010101',
                'password' => Hash::make('password'), // ⚠️ À changer en production
            ]
        );

        // Création ou mise à jour des infos utilisateur associées
        InfoUser::updateOrCreate(
            ['user_id' => $user->id], // condition
            [
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'telephone' => $user->telephone,
                'email' => $user->email,
                'password' => $user->password,
            ]
        );

        // Assigner le rôle via spatie/permission
        $user->assignRole('super-admin-betro');
    }
}
