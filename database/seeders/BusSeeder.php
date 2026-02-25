<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marques = ['Mercedes-Benz', 'MAN', 'Volvo', 'Scania', 'Iveco', 'Setra', 'Neoplan', 'Van Hool', 'Yutong', 'Higer'];
        $modeles = [
            'Mercedes-Benz' => ['Tourismo', 'Intouro', 'Citaro', 'Travego'],
            'MAN' => ['Lion\'s Coach', 'Lion\'s Intercity', 'Lion\'s Regio'],
            'Volvo' => ['9700', '8900', '7900', 'B8R'],
            'Scania' => ['Touring', 'Interlink', 'OmniExpress'],
            'Iveco' => ['Magelys', 'Evadys', 'Crossway'],
            'Setra' => ['ComfortClass', 'TopClass', 'MultiClass'],
            'Neoplan' => ['Cityliner', 'Tourliner', 'Starliner'],
            'Van Hool' => ['TX', 'CX', 'TX16'],
            'Yutong' => ['ZK6128', 'ZK6118', 'ZK6908'],
            'Higer' => ['KLQ6125', 'KLQ6115', 'KLQ6908']
        ];
        
        $villes = ['Yaoundé', 'Douala', 'Bafoussam', 'Bamenda', 'Garoua', 'Maroua', 'Ngaoundéré', 'Bertoua', 'Ebolowa', 'Buea'];
        $status = ['disponible', 'en_entretien', 'hors_service'];
        $configurations = ['2x2', '1x1', '2x1'];

        for ($i = 1; $i <= 100; $i++) {
            $marque = $marques[array_rand($marques)];
            $modele = $modeles[$marque][array_rand($modeles[$marque])];
            $immatriculation = strtoupper(Str::random(2)) . '-' . rand(100, 999) . '-' . strtoupper(Str::random(2));
            $ville = $villes[array_rand($villes)];
            $statusBus = $status[array_rand($status)];
            $configuration = $configurations[array_rand($configurations)];
            $nombrePlaces = $configuration === '1x1' ? rand(20, 30) : 
                           ($configuration === '2x1' ? rand(30, 40) : rand(40, 60));

            Bus::create([
                'info_user_id' => 10, // Assurez-vous que ces IDs existent
                'compagnies_id' => 7, // Assurez-vous que ces IDs existent
                'configuration_place_buses_id' => 1, // Assurez-vous que ces IDs existent
                'nom_bus' => 'Bus ' . $marque . ' ' . $i,
                'marque_bus' => $marque,
                'modele_bus' => $modele,
                'immatriculation_bus' => $immatriculation,
                'photo_bus' => 'bus' . rand(1, 10) . '.jpg',
                'description_bus' => 'Bus ' . $marque . ' ' . $modele . ' de ' . $ville . ' avec configuration ' . $configuration,
                'localisation_bus' => $ville,
                'nombre_places' => $nombrePlaces,
                'configuration_car' => $configuration,
                'status' => 1,
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
