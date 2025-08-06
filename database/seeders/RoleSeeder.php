<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super-admin-betro']);
        Role::create(['name' => 'sous-admin-betro']);

        Role::create(['name' => 'super-admin-compagnie']);
        Role::create(['name' => 'sous-admin-compagnie']);

        Role::create(['name' => 'super-admin-gare']);
        Role::create(['name' => 'sous-admin-gare']);

        Role::create(['name' => 'chauffeur']);
        Role::create(['name' => 'hotesse']);
        Role::create(['name' => 'agent']);

        Role::create(['name' => 'client']);
    }
}
