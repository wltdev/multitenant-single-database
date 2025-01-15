<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'company_id' => $this->company_id,
            'address_id' => $this->address_id,
            'address' => new AddressResource($this->address),
            'image' => $this->getFirstMediaUrl('clients'),

            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,

            'person_number' => $this->person_number,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'profession' => $this->profession,

            'trading_name' => $this->trading_name,
            'business_number' => $this->business_number,
            'state_registration' => $this->state_registration,
            'city_registration' => $this->city_registration,
            'suframa' => $this->suframa,
            'icms_contributor' => $this->icms_contributor,

            'type' => $this->type,
            'active' => $this->active,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
