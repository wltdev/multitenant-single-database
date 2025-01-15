<?php

namespace App\Services\Provinces;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use Mockery\Exception;

class GetOneProvinceService
{

    public function __construct(private ProvinceRepositoryInterface $repository)
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
