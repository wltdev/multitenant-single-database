<?php

namespace App\DTOs;

// use App\DTOs\AddressDTO;
use Illuminate\Http\UploadedFile;

class ProjectDTO
{
    public int $company_id;
    public ?int $client_id;
    public string $title;
    public ?string $begin_date;
    public ?string $due_date;
    public ?string $status;
    public ?array $files;
    public ?array $members;

    public function __construct(array $data)
    {
        $this->company_id = $data['company_id'];
        $this->client_id = $data['client_id'] ?? null;
        $this->title = $data['title'];
        $this->begin_date = $data['begin_date'] ?? null;
        $this->due_date = $data['due_date'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->files = $data['files'] ?? null;
        $this->members = $data['members'] ?? [];
    }

    public function toArray(): array
    {
        $arrayData = get_object_vars($this);

        return $arrayData;
    }
}
