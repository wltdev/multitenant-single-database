<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'data' => $this->data,
            'domain' => $this->domain,
            'company' => $this->company,
            'tenancy_db_name' => $this->tenancy_db_name,
            'plans' => $this->plans,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
