<?php

namespace App\Services\Provinces;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RemoveProvinceService
{

    public function __construct(private ProvinceRepositoryInterface $repository)
    {
    }

    public function execute($id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->destroy($id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
