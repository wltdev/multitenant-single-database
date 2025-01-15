<?php

namespace App\Services\Companies;

use App\Models\Company;
use App\Repositories\Company\CompanyRepositoryInterface;

class CreateCompanyService
{
    public function __construct(
        private CompanyRepositoryInterface $repository
    ) {}

    public function execute(array $payload)
    {
        $company = $this->repository->store([
            'name' => $payload['name'],
            'tenant_id' => $payload['tenant_id'],
            'email' => $payload['email'],
            'is_main' => $payload['is_main'] ?? true,
        ]);

        if (isset($payload['user_id'])) {
            $company->users()->attach($payload['user_id']);
        }

        return $company;
    }
}
