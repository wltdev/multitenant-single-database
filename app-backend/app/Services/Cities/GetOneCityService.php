<?php

namespace App\Services\Cities;

use App\Repositories\Interfaces\CityRepositoryInterface;
use Mockery\Exception;

class GetOneCityService
{

    public function __construct(private CityRepositoryInterface $repository)
    {
    }

    public function execute($id)
    {
        try {
            $records = $this->repository->find($id);
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
