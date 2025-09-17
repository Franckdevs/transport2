<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_utilisateurs')->insert([
            [
                'nom_role'   => 'Administrateur',
                'description'=> 'Accès complet à toutes les fonctionnalités',
                'status'     => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_role'   => 'Chauffeur',
                'description'=> 'Accès limité à la gestion des voyages',
                'status'     => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_role'   => 'Utilisateur',
                'description'=> 'Client ayant la possibilité de réserver un voyage',
                'status'     => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
