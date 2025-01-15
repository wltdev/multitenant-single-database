<?php

namespace App\DTOs;

class AddressDTO
{
    public string $street;
    public string $number;
    public ?string $complement;
    public string $zipcode;
    public string $neighborhood;
    public string $city_name;
    public string $province_code;

    public function __construct(array $data)
    {
        $this->street = $data['street'];
        $this->number = $data['number'];
        $this->complement = $data['complement'] ?? null;
        $this->zipcode = $data['zipcode'];
        $this->neighborhood = $data['neighborhood'];
        $this->city_name = $data['city_name'];
        $this->province_code = $data['province_code'];
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
