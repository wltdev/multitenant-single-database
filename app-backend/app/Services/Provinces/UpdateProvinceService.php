<?php

namespace App\Services\Provinces;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateProvinceService
{

    public function __construct(private ProvinceRepositoryInterface $repository)
    {
    }

    public function execute($payload, $id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->update($payload, $id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
