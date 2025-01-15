<?php

namespace App\Services\Permissions;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;

class GetOnePermissionService
{
    public function __construct(private PermissionRepositoryInterface $repository) {}

    public function execute($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
