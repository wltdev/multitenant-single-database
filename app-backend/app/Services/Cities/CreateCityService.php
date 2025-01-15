<?php

namespace App\Services\Cities;

use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateCityService
{

    public function __construct(private CityRepositoryInterface $repository)
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
