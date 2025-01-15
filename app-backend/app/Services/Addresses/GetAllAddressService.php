<?php

namespace App\Services\Addresses;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use Mockery\Exception;

class GetAllAddressService
{

    public function __construct(private AddressRepositoryInterface $repository)
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
