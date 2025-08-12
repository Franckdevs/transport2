<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $villes = [
            'Abidjan',
            'Bouaké',
            'Yamoussoukro',
            'San-Pédro',
            'Korhogo',
            'Man',
            'Daloa'
        ];
        foreach ($villes as $ville) {
            DB::table('villes')->insert([
                'nom_ville' => $ville,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
