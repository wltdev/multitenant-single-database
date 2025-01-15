<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'trading_name' => $this->trading_name,
            'identification_name' => $this->identification_name,

            'country' => $this->country,
            'zipcode' => $this->zipcode,
            'province' => $this->province,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,

            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'email' => $this->email,
            'site' => $this->site,

            'cnae' => $this->cnae,
            'cnpj' => $this->cnpj,
            'state_registration' => $this->state_registration,
            'state_registration_tax_replacement' => $this->state_registration_tax_replacement,
            'city_registration' => $this->city_registration,
            'suframa' => $this->suframa,

            'headquarter' => $this->headquarter,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
