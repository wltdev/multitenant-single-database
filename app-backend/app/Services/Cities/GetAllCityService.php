<?php

namespace App\Services\Cities;

use App\Repositories\Interfaces\CityRepositoryInterface;
use Mockery\Exception;

class GetAllCityService
{

    public function __construct(private CityRepositoryInterface $repository)
    {
    }

    public function execute()
    {
        try {
            $records = $this->repository->getAll();
            return $records;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
