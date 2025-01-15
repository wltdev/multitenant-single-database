<?php

namespace App\Services\Permissions;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class DeletePermissionService
{
    public function __construct(private PermissionRepositoryInterface $repository) {}


    public function execute(int $id)
    {
        try {
            DB::beginTransaction();

            $delted = $this->repository->destroy($id);

            DB::commit();

            return $delted;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
