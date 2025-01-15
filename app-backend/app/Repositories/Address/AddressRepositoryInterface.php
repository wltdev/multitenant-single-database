<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface AddressRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Address $model);
}
