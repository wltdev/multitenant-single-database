<?php

namespace App\Services\Tenants;

use App\Models\Tenant;

class CreateTenantDomainService
{
    public function execute(Tenant $tenant, array $payload)
    {
        $tenant->createDomain(['domain' => $payload['domain']]);
    }
}
