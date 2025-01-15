<?php

namespace App\Services\Provinces;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use Mockery\Exception;

class GetAllProvinceService
{

    public function __construct(private ProvinceRepositoryInterface $repository)
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
