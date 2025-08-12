<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jours = [
            'Lundi',
            'Mardi',
            'Mercredi',
            'Jeudi',
            'Vendredi',
            'Samedi',
            'Dimanche',
            'Tous les jours'
        ];

        foreach ($jours as $jour) {
            DB::table('jours')->insert([
                'nom_jour' => $jour,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
