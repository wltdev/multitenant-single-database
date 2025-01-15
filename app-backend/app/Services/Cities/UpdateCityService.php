<?php

namespace App\Services\Cities;

use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateCityService
{

    public function __construct(private CityRepositoryInterface $repository)
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
