<?php

namespace App\Repositories\TenantPlan;

use App\Models\TenantPlan;
use App\Repositories\Interfaces\GenericRepositoryInterface;

interface TenantPlanRepositoryInterface extends GenericRepositoryInterface
{
    public function __construct(TenantPlan $model);
}
