<?php

namespace App\Services\Addresses;

use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UpdateAddressService
{

    public function __construct(
        private AddressRepositoryInterface $repository,
        private CityRepositoryInterface $cityRepository,
        private ProvinceRepositoryInterface $provinceRepositoryInterface
    ) {}

    public function execute($payload, $id)
    {
        try {
            DB::beginTransaction();

            $province = $this->provinceRepositoryInterface->findByCode($payload['province_code']);

            $city = $this->cityRepository->findOrCreate([
                'name' => $payload['city_name'],
                'province_id' => $province->id
            ]);

            $payload['city_id'] = $city->id;

            $record = $this->repository->update($payload, $id);

            DB::commit();

            return $record;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
