<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Primeiro criamos as permissões (que são globais)
        $permissions = config('permissions');

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name'], 'guard_name' => 'sanctum']
            );
        }

        // Cria a role de admin central
        $adminRole = Role::firstOrCreate(
            ['name' => 'central-admin', 'guard_name' => 'sanctum']
        );

        // Atribui todas as permissões ao admin central
        $adminRole->syncPermissions(Permission::all());
    }
}
