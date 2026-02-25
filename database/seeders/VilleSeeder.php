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
        //  $villes = [
        //     // District Autonome d'Abidjan
        //     'Abidjan',
        //     'Yopougon',
        //     'Cocody',
        //     'Treichville',
        //     'Port-Bouët',
        //     'Adjamé',
        //     'Attécoubé',
        //     'Le Plateau',
        //     'Marcory',
        //     'Koumassi',
        //     'Bingerville',
        //     'Songon',
        //     'Anyama',
        //     'Bingerville',
            
        //     // District Autonome de Yamoussoukro
        //     'Yamoussoukro',
            
        //     // Région des Lagunes
        //     'Dabou',
        //     'Grand-Lahou',
        //     'Jacqueville',
        //     'Tiagba',
            
        //     // Région du Bas-Sassandra
        //     'San-Pédro',
        //     'Sassandra',
        //     'Soubré',
        //     'Tabou',
            
        //     // Région de la Comoé
        //     'Abengourou',
        //     'Agnibilékrou',
        //     'Bettié',
            
        //     // Région des Savanes
        //     'Korhogo',
        //     'Ferkessédougou',
        //     'Boundiali',
        //     'Tingréla',
        //     'Dikodougou',
        //     'Sinématiali',
            
        //     // Région de la Vallée du Bandama
        //     'Bouaké',
        //     'Sakassou',
        //     'Béoumi',
        //     'Katiola',
        //     'Dabakala',
            
        //     // Région du Zanzan
        //     'Bondoukou',
        //     'Bouna',
        //     'Tanda',
        //     'Téhini',
            
        //     // Région du Woroba
        //     'Séguéla',
        //     'Mankono',
        //     'Vavoua',
        //     'Kounahiri',
            
        //     // Région du Gôh-Djiboua
        //     'Gagnoa',
        //     'Oumé',
        //     'Divo',
        //     'Guibéroua',
        //     'Hiré',
            
        //     // Région de la Nawa
        //     'Soubré',
        //     'Méagui',
        //     'Buyo',
            
        //     // Région du Bafing
        //     'Touba',
        //     'Koro',
        //     'Ouaninou',
            
        //     // Région du Poro
        //     'Korhogo',
        //     'Dikodougou',
        //     'Sinématiali',
            
        //     // Région du Tchologo
        //     'Ferkessédougou',
        //     'Kong',
        //     'Ouangolodougou',
            
        //     // Région de l'Hambol
        //     'Katiola',
        //     'Niakaramandougou',
        //     "M'Bahiakro",
            
        //     // Région du Gontougo
        //     'Bondoukou',
        //     'Tanda',
        //     'Téhini',
            
        //     // Région du Bounkani
        //     'Bouna',
        //     'Doropo',
        //     'Nassian',
            
        //     // Autres villes importantes
        //     'Daloa',
        //     'Man',
        //     'Odienné',
        //     'Danané',
        //     'Guiglo',
        //     'Duékoué',
        //     'Toumodi',
        //     'Dimbokro',
        //     'Daoukro',
        //     'Issia',
        //     'Sinfra',
        //     'Zouan-Hounien',
        //     'Toulepleu',
        //     'Bangolo',
        //     'Biankouma',
        //     'Touba',
        //     'Mankono',
        //     'Séguéla',
        //     'Vavoua',
        //     'Zuénoula',
        //     'Bouaflé',
        //     'Sinfra',
        //     'Oumé',
        //     'Divo',
        //     'Lakota',
        //     'Adzopé',
        //     'Alépé',
        //     'Bocanda',
        //     'Dabou',
        //     'Grand-Bassam',
        //     'Adiaké',
        //     'Aboisso',
        //     'Bonoua',
        //     'Ayamé',
        //     'Agnibilékrou',
        //     'Bettié',
        //     'Bondoukou',
        //     'Bouna',
        //     'Tanda',
        //     'Téhini',
        //     'Bondoukou',
        //     'Bouna',
        //     'Tanda',
        //     'Téhini',
        //     'Bondoukou',
        //     'Bouna',
        //     'Tanda',
        //     'Téhini'
        // ];

        $villes = [
        "Abidjan",
        "Abobo",
        "Bouaké",
        "Daloa",
        "Yamoussoukro",
        "San-Pédro",
        "Korhogo",
        "Man",
        "Divo",
        "Gagnoa",
        "Abengourou",
        "Anyama",
        "Agboville",
        "Grand-Bassam",
        "Dabou",
        "Dimbokro",
        "Ferkessédougou", 
        "Adzopé",
        "Bouaflé",
        "Sinfra",
        "Katiola",
        "Bondoukou",
        "Danané",
        "Oumé",
        "Séguéla",
        "Bingerville",
        "Issia",
        "Odienné",
        "Duékoué",
        "Agnibilékrou",
        "Daoukro",
        "Tengréla",
        "Guiglo",
        "Toumodi",
        "Boundiali",
        "Lakota",
        "Aboisso",
        "Arrah",
        "Bonoua",
        "Akoupé",
        "Tiassalé",
        "Zuenoula",
        "Bongouanou",
        "Vavoua",
        "Afféry",
        "Touba",
        "Bouna",
        "Sassandra",
        "Beoumi",
        "Biankouma",
        "Tanda",
        "Mankono",
        "Bangolo",
        "Tabou",
        "Adiake",
        "Sakassou",
        "Toulépleu",
        "Dabakala",
        "Botro",
        "Guibéroua",
        "Bocanda",
        "Ayamé",
        "Grand-Lahou"
        ];
        // Suppression des doublons
        $villes = array_unique($villes);
        // Vérifier si la table est vide avant d'insérer
        if (DB::table('villes')->count() === 0) {
            foreach ($villes as $ville) {
                DB::table('villes')->insert([
                    'nom_ville' => $ville,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info('Villes de la Côte d\'Ivoire ajoutées avec succès !');
        } else {
            $this->command->info('La table des villes n\'est pas vide. Aucune donnée n\'a été insérée.');
        }

    }
}
