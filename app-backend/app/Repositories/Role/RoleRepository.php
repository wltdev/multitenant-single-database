<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{
    public function __construct(private Role $model) {}

    public function getAll()
    {
        return $this->model->with('permissions')->get();
    }

    public function store(array $payload)
    {
        return $this->model->create($payload);
    }

    public function insert(array $payload)
    {
        return $this->model->insert($payload);
    }

    public function find($id)
    {
        return $this->model->with('permissions')->findOrFail($id);
    }

    public function update($payload, $id)
    {
        $role = $this->model->findOrFail($id);
        
        // Atualizar dados básicos da role
        $role->fill($payload);
        $role->save();

        // Se houver permissões no payload, sincronizar
        if (isset($payload['permissions'])) {
            $permissions = Permission::whereIn('name', $payload['permissions'])->get();
            $role->syncPermissions($permissions);
        }

        return $role->load('permissions');
    }

    public function destroy($id)
    {
        $role = $this->model->findOrFail($id);
        
        // Remover todas as permissões antes de deletar
        $role->syncPermissions([]);
        
        $role->delete();
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}
