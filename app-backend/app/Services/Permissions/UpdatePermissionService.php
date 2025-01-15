<?php

namespace App\Services\Permissions;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdatePermissionService
{
    public function __construct(private PermissionRepositoryInterface $repository) {}


    public function execute(array $payload, int $id)
    {
        DB::beginTransaction();

        try {
            $record = $this->repository->update($payload, $id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
