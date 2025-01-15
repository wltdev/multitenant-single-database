<?php

namespace App\Services\Provinces;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateProvinceService
{

    public function __construct(private ProvinceRepositoryInterface $repository)
    {
    }

    public function execute($request)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->store($request);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
