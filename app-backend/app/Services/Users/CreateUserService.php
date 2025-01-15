<?php

namespace App\Services\Users;

use App\Repositories\User\UserRepositoryInterface;

class CreateUserService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * @param array $payload
     * @return mixed
     */
    public function execute(array $payload)
    {
        try {
            return $this->userRepository->store($payload);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
