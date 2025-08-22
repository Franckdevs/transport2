<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermission extends Command
{
    protected $signature = 'permission:add {name} {--role=* : Assign to specific roles}';
    protected $description = 'Add a new permission and optionally assign it to roles';

    public function handle()
    {
        $permissionName = $this->argument('name');
        $roles = $this->option('role');

        // Créer la permission
        $permission = Permission::firstOrCreate(['name' => $permissionName]);
        
        if ($permission->wasRecentlyCreated) {
            $this->info("Permission '{$permissionName}' created successfully.");
        } else {
            $this->warn("Permission '{$permissionName}' already exists.");
        }

        // Assigner aux rôles si spécifiés
        if (!empty($roles)) {
            foreach ($roles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $role->givePermissionTo($permission);
                    $this->info("Permission assigned to role '{$roleName}'.");
                } else {
                    $this->error("Role '{$roleName}' not found.");
                }
            }
        }

        return 0;
    }
}
