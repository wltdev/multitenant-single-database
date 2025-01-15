<?php

namespace App\Services\Tenants;

use App\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateTenantInitialRolesService
{
    private $tenant;
    public function execute($tenant): Role
    {
        $this->tenant = $tenant;
        // Primeiro, vamos criar todas as permissões
        $this->createPermissions();

        // Depois, vamos criar as roles e atribuir as permissões
        return $this->createRoles();
    }

    private function createPermissions()
    {
        $permissionsConfig = config('permissions');

        foreach ($permissionsConfig as $permission) {
            Permission::findOrCreate($permission['name'], 'api');
        }
    }

    private function createRoles()
    {

        // Cria a role de admin com todas as permissões
        $adminRole = Role::firstOrCreate([
            'name' => 'Administrador',
            'tenant_id' => $this->tenant->id,
            'guard_name' => 'api'
        ]);

        $allPermissions = Permission::where('guard_name', 'api')->get();

        $adminRole->syncPermissions($allPermissions);

        // Cria a role de user com permissões básicas
        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'tenant_id' => $this->tenant->id,
            'guard_name' => 'api'
        ]);

        $userPermissions = Permission::where('guard_name', 'api')
            ->whereIn('name', [
                'users.read',
                'companies.read',
                'projects.read',
                'leads.read',
                'kanban-boards.read',

                'projects.create',
                'projects.update',

                'leads.create',
                'leads.update',

                'kanban-boards.create',
                'kanban-boards.update',
            ])
            ->get();

        $userRole->syncPermissions($userPermissions);

        // Cria a role de guest com permissões mínimas
        $guestRole = Role::firstOrCreate([
            'name' => 'guest',
            'tenant_id' => $this->tenant->id,
            'guard_name' => 'api'
        ]);

        $guestPermissions = Permission::where('guard_name', 'api')
            ->whereIn('name', [
                'projects.read',
                'leads.read',
                'kanban-boards.read',
            ])
            ->get();

        $guestRole->syncPermissions($guestPermissions);

        return $adminRole;
    }
}
