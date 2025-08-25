<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        $roles = [
            'super-admin-betro',
            'sous-admin-betro',
            'super-admin-compagnie',
            'super-admin-gare',
            'sous-admin-compagnie',
            'sous-admin-gare',
            'chauffeur',
            'hotesse',
            'agent',
            'client',
        ];

        foreach ($roles as $roleName) {
        Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }
}
