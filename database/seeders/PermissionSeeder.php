<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        //permission betro
        Permission::firstOrCreate(['name' => 'voir-tableau-de-bord-betro']);

        Permission::firstOrCreate(['name' => 'betro-voir-compagnies']);
        Permission::firstOrCreate(['name' => 'betro-ajouter-compagnie']);
        Permission::firstOrCreate(['name' => 'betro-modifier-compagnie']);
        Permission::firstOrCreate(['name' => 'betro-supprimer-compagnie']);
        Permission::firstOrCreate(['name' => 'betro-show-compagnie']);

        //companies et gares
        Permission::firstOrCreate(['name' => 'tableau-de-bord-compagnies']);
        Permission::firstOrCreate(['name' => 'bus-cars']);
        Permission::firstOrCreate(['name' => 'chauffeurs']);
        Permission::firstOrCreate(['name' => 'utilisateurs']);
        Permission::firstOrCreate(['name' => 'itineraires']);
        Permission::firstOrCreate(['name' => 'voyages']);
        Permission::firstOrCreate(['name' => 'ajouter-une-gars']);

        Permission::firstOrCreate(['name' => 'tout-les-permissions']);
    }
}
