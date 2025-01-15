<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface CityRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(City $model);

    public function findOrCreate(array $payload);
}
