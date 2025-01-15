<?php

namespace App\DTOs;

use App\DTOs\AddressDTO;
use Illuminate\Http\UploadedFile;

class ClientDTO
{
    public int $company_id;
    public ?int $address_id;
    public string $name;
    public ?string $email;
    public ?string $phone;
    public ?string $person_number;
    public ?string $birthdate;
    public ?string $gender;
    public ?string $profession;
    public ?string $trading_name;
    public ?string $business_number;
    public ?string $state_registration;
    public ?string $city_registration;
    public ?string $suframa;
    public ?bool $icms_contributor;
    public ?string $type;
    public ?bool $active;
    public ?UploadedFile $file;

    public AddressDTO $address;

    public function __construct(array $data, UploadedFile $file = null)
    {
        $this->company_id = $data['company_id'];
        $this->address_id = $data['address_id'] ?? null;
        $this->name = $data['name'];
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->person_number = $data['person_number'] ?? null;
        $this->birthdate = $data['birthdate'] ?? null;
        $this->gender = $data['gender'] ?? null;
        $this->profession = $data['profession'] ?? null;
        $this->trading_name = $data['trading_name'] ?? null;
        $this->business_number = $data['business_number'] ?? null;
        $this->state_registration = $data['state_registration'] ?? null;
        $this->city_registration = $data['city_registration'] ?? null;
        $this->suframa = $data['suframa'] ?? null;
        $this->icms_contributor = $data['icms_contributor'] ?? 0;
        $this->type = $data['type'] ?? 'individual';
        $this->active = $data['active'] ?? true;
        $this->file = $file;

        // Initialize AddressDTO
        $this->address = new AddressDTO($data['address']);
    }

    public function toArray(): array
    {
        $clientData = get_object_vars($this);
        $clientData['address'] = $this->address->toArray();

        return $clientData;
    }
}
