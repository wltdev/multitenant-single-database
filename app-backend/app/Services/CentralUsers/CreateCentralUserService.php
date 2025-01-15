<?php

namespace App\Services\CentralUsers;

use App\Repositories\CentralUser\CentralUserRepositoryInterface;

class CreateCentralUserService
{
    public function __construct(private CentralUserRepositoryInterface $centralUserRepository) {}
    public function execute(array $payload)
    {
        return $this->centralUserRepository->store($payload);
    }
}
