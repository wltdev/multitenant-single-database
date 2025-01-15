<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface TenantRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(Tenant $model);
}
