<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = is_array($this->resource) ? $this->resource['user'] : $this->resource;

        $permissions = [];
        foreach ($user->getAllPermissions() as $permission) {
            $permissions[] = $permission->name;
        }

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'tenant_id' => $user->tenant_id,
            'company_id' => $user->company_id,
            'plans' => [], //$user->tenant->plans,
            'roles' => $user->getRoleNames(),
            'permissions' => $permissions
        ];
    }
}
