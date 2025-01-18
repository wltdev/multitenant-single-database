<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permissions = [];

        foreach ($this->getAllPermissions() as $permission) {
            $permissions[] = $permission->name;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'tenant_id' => $this->tenant_id,
            'roles' => $this->getRoleNames(),
            'role_id' => $this->roles->pluck('id'),
            'image' => $this->getFirstMediaUrl('users'),
            'permissions' => $permissions,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
