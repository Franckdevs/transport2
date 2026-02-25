<?php

namespace Database\Factories;

use App\Models\Chauffeur;
use App\Models\InfoUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChauffeurFactory extends Factory
{
    protected $model = Chauffeur::class;

    public function definition()
    {
        return [
            'info_user_id' => 10,    
            'compagnies_id' => 7, // À adapter selon vos besoins
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'telephone' => $this->faker->unique()->phoneNumber,
            'adresse' => $this->faker->address,
            'numeros_permis' => 'PERMIS' . $this->faker->unique()->numberBetween(1000, 9999),
            'date_naissance' => $this->faker->dateTimeBetween('-50 years', '-25 years')->format('Y-m-d'),
            'status' => $this->faker->randomElement([1, 3]), // 1 = actif, 3 = inactif
            'photo' => null, // ou une URL d'image de test
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}   
