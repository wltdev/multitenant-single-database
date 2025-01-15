<?php

namespace App\Services\Permissions;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePermissionService
{
    public function __construct(private PermissionRepositoryInterface $repository) {}

    public function execute($payload)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->store($payload);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
