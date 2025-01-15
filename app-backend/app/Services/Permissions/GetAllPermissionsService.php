<?php

namespace App\Services\Permissions;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;

class GetAllPermissionsService
{
    public function __construct(private PermissionRepositoryInterface $repository) {}

    public function execute()
    {
        try {
            return $this->repository->getAll();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
