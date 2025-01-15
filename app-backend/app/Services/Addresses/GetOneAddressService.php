<?php

namespace App\Services\Addresses;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use Mockery\Exception;

class GetOneAddressService
{

    public function __construct(private AddressRepositoryInterface $repository)
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
