<?php

namespace App\Repositories\Province;

use App\Models\Province;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface ProvinceRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Province $model);

    public function findByCode(string $code);
}
