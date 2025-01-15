<?php

namespace App\DTOs;



class ProjectMemberDTO
{
    public ?int $project_id;
    public int $user_id;
    public string $role;

    public function __construct(array $data)
    {
        // dd($data);
        $this->project_id = $data['project_id'] ?? null;
        $this->user_id = $data['user_id'];
        $this->role = $data['role'];
    }

    public function toArray(): array
    {
        $arrayData = get_object_vars($this);

        return $arrayData;
    }
}
