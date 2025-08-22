<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions pour BETRO (Administration générale)
        Permission::firstOrCreate(['name' => 'voir-tableau-de-bord-betro']);
        Permission::firstOrCreate(['name' => 'gerer-compagnies']);
        Permission::firstOrCreate(['name' => 'gerer-gares']);
        Permission::firstOrCreate(['name' => 'gerer-utilisateurs']);
        Permission::firstOrCreate(['name' => 'voir-statistiques']);
        Permission::firstOrCreate(['name' => 'gerer-parametres-systeme']);
        Permission::firstOrCreate(['name' => 'voir-tous-rapports']);

        // Permissions pour Compagnies
        Permission::firstOrCreate(['name' => 'voir-tableau-de-bord-compagnie']);
        Permission::firstOrCreate(['name' => 'gerer-bus']);
        Permission::firstOrCreate(['name' => 'gerer-personnel']);
        Permission::firstOrCreate(['name' => 'gerer-voyages']);
        Permission::firstOrCreate(['name' => 'voir-rapports-compagnie']);
        Permission::firstOrCreate(['name' => 'gerer-itineraires']);
        Permission::firstOrCreate(['name' => 'gerer-tarifs']);

        // Permissions pour Gares
        Permission::firstOrCreate(['name' => 'voir-tableau-de-bord-gare']);
        Permission::firstOrCreate(['name' => 'gerer-quais']);
        Permission::firstOrCreate(['name' => 'voir-arrivees-departs']);
        Permission::firstOrCreate(['name' => 'gerer-infos-gare']);
        Permission::firstOrCreate(['name' => 'voir-statistiques-gare']);

        // Permissions pour Personnel
        Permission::firstOrCreate(['name' => 'voir-planning']);
        Permission::firstOrCreate(['name' => 'mettre-a-jour-statut']);
        Permission::firstOrCreate(['name' => 'voir-voyages-assignes']);
        Permission::firstOrCreate(['name' => 'gerer-profil']);

        // Permissions pour Clients
        Permission::firstOrCreate(['name' => 'reserver-billets']);
        Permission::firstOrCreate(['name' => 'voir-reservations']);
        Permission::firstOrCreate(['name' => 'annuler-reservations']);
        Permission::firstOrCreate(['name' => 'voir-horaires']);

        // Permissions générales
        Permission::firstOrCreate(['name' => 'creer']);
        Permission::firstOrCreate(['name' => 'lire']);
        Permission::firstOrCreate(['name' => 'mettre-a-jour']);
        Permission::firstOrCreate(['name' => 'supprimer']);
        Permission::firstOrCreate(['name' => 'exporter']);
        Permission::firstOrCreate(['name' => 'importer']);

        // Une seule fois ici
        Permission::firstOrCreate(['name' => 'tout-les-permissions']);
    }
}
