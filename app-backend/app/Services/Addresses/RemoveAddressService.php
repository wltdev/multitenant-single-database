<?php

namespace App\Services\Addresses;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RemoveAddressService
{

    public function __construct(private AddressRepositoryInterface $repository)
    {
    }

    public function execute($id)
    {
        try {
            DB::beginTransaction();

            $record = $this->repository->destroy($id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
