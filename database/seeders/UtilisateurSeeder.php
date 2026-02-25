<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Données des utilisateurs à créer
        $utilisateurs = [
            // Administrateur
            [
                'nom' => 'Admin',
                'prenom' => 'BETRO',
                'email' => 'admin@betro.ci',
                'telephone' => '+2250700000000',
                'password' => Hash::make('password'),
                'status' => '1',
               
            ],
            // Gestionnaires
            [
                'nom' => 'Kouassi',
                'prenom' => 'Amani',
                'email' => 'gestion1@betro.ci',
                'telephone' => '+2250700000001',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Yao',
                'prenom' => 'Koffi',
                'email' => 'gestion2@betro.ci',
                'telephone' => '+2250700000002',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            // Clients
            [
                'nom' => 'Konan',
                'prenom' => 'Jean',
                'email' => 'client1@example.com',
                'telephone' => '+2250500000001',
                'password' => Hash::make('password'),
                'status' => '1',
               
            ],
            [
                'nom' => 'Bamba',
                'prenom' => 'Aminata',
                'email' => 'client2@example.com',
                'telephone' => '+2250500000002',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Kouame',
                'prenom' => 'Martial',
                'email' => 'client3@example.com',
                'telephone' => '+2250500000003',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Soro',
                'prenom' => 'Fatou',
                'email' => 'client4@example.com',
                'telephone' => '+2250500000004',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Kone',
                'prenom' => 'Ibrahim',
                'email' => 'client5@example.com',
                'telephone' => '+2250500000005',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Toure',
                'prenom' => 'Aïcha',
                'email' => 'client6@example.com',
                'telephone' => '+2250500000006',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Kouadio',
                'prenom' => 'Yves',
                'email' => 'client7@example.com',
                'telephone' => '+2250500000007',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ],
            [
                'nom' => 'Yao',
                'prenom' => 'Aminata',
                'email' => 'client8@example.com',
                'telephone' => '+2250500000008',
                'password' => Hash::make('password'),
                'status' => '1',
                
            ]
        ];

        foreach ($utilisateurs as $utilisateurData) {
            // Vérifier si l'utilisateur existe déjà
            $utilisateur = Utilisateur::where('email', $utilisateurData['email'])->first();
            
            if (!$utilisateur) {
                // Créer l'utilisateur
                $utilisateur = Utilisateur::create([
                    'nom' => $utilisateurData['nom'],
                    'prenom' => $utilisateurData['prenom'],
                    'email' => $utilisateurData['email'],
                    'telephone' => $utilisateurData['telephone'],
                    'password' => $utilisateurData['password'],
                    'status' => $utilisateurData['status'],
                    'token' => \Illuminate\Support\Str::random(60),
                ]);

                // Créer un token d'API
                $apiToken = $utilisateur->createToken('auth-token')->plainTextToken;
                
                $this->command->info('Utilisateur créé : ' . $utilisateurData['email']);
            } else {
                $this->command->info('Utilisateur existe déjà : ' . $utilisateurData['email']);
            }
        }
    }
}
