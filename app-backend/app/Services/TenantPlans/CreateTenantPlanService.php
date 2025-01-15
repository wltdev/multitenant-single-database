<?php

namespace App\Services\TenantPlans;

use App\Repositories\TenantPlan\TenantPlanRepositoryInterface;

class CreateTenantPlanService
{
    public function __construct(
        private TenantPlanRepositoryInterface $planRepository
    ) {}

    public function execute(array $payload)
    {
        return $this->planRepository->store($payload);
    }
}
