<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gare;
use App\Models\Compagnies;
use App\Models\Ville;
use App\Models\Jour;
use Illuminate\Support\Facades\DB;

class GareSeeder extends Seeder
{
    public function run()
    {
        // Vérifier si la table est vide avant d'insérer
        if (Gare::count() > 0) {
            $this->command->info('Des gares existent déjà. Aucune donnée n\'a été insérée.');
            return;
        }

        $gares = [
            // Gare d'Abidjan (Plateau)
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Abidjan')->first()->id,
                'jour_id' => 1,
                'telephone' => '20202020',
                'admin_nom' => 'Kouassi',
                'admin_prenom' => 'Jean',
                'admin_email' => 'gare.abidjan@example.com',
                'admin_telephone' => '07080910',
                'nom_gare' => 'Gare Routière d\'Adjamé',
                'adresse_gare' => 'Boulevard de la Paix, Adjamé',
                'telephone_gare' => '20212223',
                'email' => 'contact@gareadjame.ci',
                'site_web' => 'https://gareadjame.ci',
                'description' => 'Principale gare routière d\'Abidjan, point de départ pour de nombreuses destinations.',
                'latitude' => '5.336318',
                'longitude' => '-4.027751',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare de Bouaké
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Bouaké')->first()->id,
                'jour_id' => 1,
                'telephone' => '30303030',
                'admin_nom' => 'Yao',
                'admin_prenom' => 'Martial',
                'admin_email' => 'gare.bouake@example.com',
                'admin_telephone' => '07010203',
                'nom_gare' => 'Gare Routière de Bouaké',
                'adresse_gare' => 'Boulevard de la République',
                'telephone_gare' => '30313233',
                'email' => 'contact@garebouake.ci',
                'site_web' => 'https://garebouake.ci',
                'description' => 'Gare principale de Bouaké, carrefour du centre de la Côte d\'Ivoire.',
                'latitude' => '7.690278',
                'longitude' => '-5.028056',
                'parking_disponible' => true,
                'wifi_disponible' => false,
            ],
            // Gare de San-Pédro
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'San-Pédro')->first()->id,
                'jour_id' => 1,
                'telephone' => '34343434',
                'admin_nom' => 'Kouamé',
                'admin_prenom' => 'Aline',
                'admin_email' => 'gare.sanpedro@example.com',
                'admin_telephone' => '07040506',
                'nom_gare' => 'Gare Routière de San-Pédro',
                'adresse_gare' => 'Avenue du Port',
                'telephone_gare' => '34353637',
                'email' => 'contact@garesanpedro.ci',
                'site_web' => 'https://garesanpedro.ci',
                'description' => 'Gare principale de San-Pédro, proche du port autonome.',
                'latitude' => '4.745447',
                'longitude' => '-6.643960',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare de Korhogo
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Korhogo')->first()->id,
                'jour_id' => 1,
                'telephone' => '36363636',
                'admin_nom' => 'Soro',
                'admin_prenom' => 'Moussa',
                'admin_email' => 'gare.korhogo@example.com',
                'admin_telephone' => '07070809',
                'nom_gare' => 'Gare du Nord',
                'adresse_gare' => 'Avenue des Écoles',
                'telephone_gare' => '36373839',
                'email' => 'contact@garekoro.ci',
                'site_web' => 'https://garekoro.ci',
                'description' => 'Gare principale du nord de la Côte d\'Ivoire.',
                'latitude' => '9.457943',
                'longitude' => '-5.629980',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare de Man
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Man')->first()->id,
                'jour_id' => 1,
                'telephone' => '37373737',
                'admin_nom' => 'Gouessé',
                'admin_prenom' => 'Aimée',
                'admin_email' => 'gare.man@example.com',
                'admin_telephone' => '07091011',
                'nom_gare' => 'Gare des Montagnes',
                'adresse_gare' => 'Route de Danané',
                'telephone_gare' => '37383940',
                'email' => 'contact@gareman.ci',
                'site_web' => 'https://gareman.ci',
                'description' => 'Gare principale de la région des montagnes.',
                'latitude' => '7.412510',
                'longitude' => '-7.553833',
                'parking_disponible' => true,
                'wifi_disponible' => false,
            ],
            // Gare de Daloa
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Daloa')->first()->id,
                'jour_id' => 1,
                'telephone' => '32323232',
                'admin_nom' => 'Kouamé',
                'admin_prenom' => 'Bernard',
                'admin_email' => 'gare.daloa@example.com',
                'admin_telephone' => '07121314',
                'nom_gare' => 'Gare Centrale de Daloa',
                'adresse_gare' => 'Boulevard des Martyrs',
                'telephone_gare' => '32333435',
                'email' => 'contact@garedaloa.ci',
                'site_web' => 'https://garedaloa.ci',
                'description' => 'Gare principale de Daloa, carrefour du centre-ouest.',
                'latitude' => '6.874302',
                'longitude' => '-6.451370',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare de Yamoussoukro
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Yamoussoukro')->first()->id,
                'jour_id' => 1,
                'telephone' => '30313233',
                'admin_nom' => 'Konan',
                'admin_prenom' => 'Henriette',
                'admin_email' => 'gare.yamoussoukro@example.com',
                'admin_telephone' => '07151617',
                'nom_gare' => 'Gare de la Paix',
                'adresse_gare' => 'Avenue Houphouët-Boigny',
                'telephone_gare' => '30313233',
                'email' => 'contact@gareyako.ci',
                'site_web' => 'https://gareyako.ci',
                'description' => 'Gare principale de la capitale politique ivoirienne.',
                'latitude' => '6.816667',
                'longitude' => '-5.283333',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare d'Abengourou
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Abengourou')->first()->id,
                'jour_id' => 1,
                'telephone' => '35353535',
                'admin_nom' => 'Amani',
                'admin_prenom' => 'Patrice',
                'admin_email' => 'gare.abengourou@example.com',
                'admin_telephone' => '07181920',
                'nom_gare' => 'Gare de l\'Indénié',
                'adresse_gare' => 'Avenue du Stade',
                'telephone_gare' => '35363738',
                'email' => 'contact@gareabg.ci',
                'site_web' => 'https://gareabg.ci',
                'description' => 'Gare principale de la région de l\'Indénié-Djuablin.',
                'latitude' => '6.729634',
                'longitude' => '-3.491689',
                'parking_disponible' => true,
                'wifi_disponible' => false,
            ],
            // Gare de Gagnoa
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Gagnoa')->first()->id,
                'jour_id' => 1,
                'telephone' => '31313131',
                'admin_nom' => 'Gouaméné',
                'admin_prenom' => 'Thérèse',
                'admin_email' => 'gare.gagnoa@example.com',
                'admin_telephone' => '07212223',
                'nom_gare' => 'Gare du Fromager',
                'adresse_gare' => 'Boulevard des Martyrs',
                'telephone_gare' => '31323334',
                'email' => 'contact@garegagnoa.ci',
                'site_web' => 'https://garegagnoa.ci',
                'description' => 'Gare principale de la région du Gôh.',
                'latitude' => '6.137740',
                'longitude' => '-5.908650',
                'parking_disponible' => true,
                'wifi_disponible' => true,
            ],
            // Gare de Bondoukou
            [
                'info_user_id' => 1,
                'ville_id' => Ville::where('nom_ville', 'Bondoukou')->first()->id,
                'jour_id' => 1,
                'telephone' => '35353535',
                'admin_nom' => 'Coulibaly',
                'admin_prenom' => 'Adama',
                'admin_email' => 'gare.bondoukou@example.com',
                'admin_telephone' => '07242526',
                'nom_gare' => 'Gare du Zanzan',
                'adresse_gare' => 'Avenue de la Paix',
                'telephone_gare' => '35363738',
                'email' => 'contact@garebondo.ci',
                'site_web' => 'https://garebondo.ci',
                'description' => 'Gare principale de la région du Zanzan.',
                'latitude' => '8.040200',
                'longitude' => '-2.800000',
                'parking_disponible' => true,
                'wifi_disponible' => false,
            ]
        ];

        // Ajout des champs manquants à chaque gare
        foreach ($gares as &$gare) {
            $gare['compagnie_id'] = 1;
            $gare['heure_ouverture'] = '06:00:00';
            $gare['heure_fermeture'] = '23:00:00';
            $gare['created_at'] = now();
            $gare['updated_at'] = now();
        }

        // Insérer toutes les gares
        DB::table('gares')->insert($gares);

        $this->command->info('10 gares ont été créées avec succès !');
    }
}
