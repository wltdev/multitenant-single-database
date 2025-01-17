<?php

namespace App\Services\Tenants;

use App\Repositories\Tenant\TenantRepositoryInterface;
use App\Services\Auth\AuthenticateUserService;
use App\Services\Companies\CreateCompanyService;
use App\Services\TenantPlans\CreateTenantPlanService;
use App\Services\Users\CreateUserService;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Tenancy;

class CreateTenantService
{
    public function __construct(
        private TenantRepositoryInterface $tenantRepository,
        private CreateTenantDomainService $createTenantDomainService,
        private AuthenticateUserService $authenticateUserService,
        private CreateTenantInitialKanbanBoardsService $createTenantInitialKanbanBoardsService,
        private CreateUserService $createUserService,
        private CreateTenantPlanService $createTenantPlanService,
        private CreateCompanyService $createCompanyService,
        private CreateTenantInitialRolesService $createTenantInitialRolesService
    ) {}

    public function execute(array $payload)
    {
        DB::beginTransaction();

        try {
            $tenant = $this->tenantRepository->store(['name' => $payload['name']]);

            $adminRole = $this->createTenantInitialRolesService->execute($tenant);

            $this->createTenantPlanService->execute([
                'tenant_id' => $tenant->id,
                'plan_id' => 1,
                'expires_at' => now()->addDays(7),
                'status' => 'active'
            ]);

            $tenantUser = $this->createUserService->execute([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'tenant_id' => $tenant->id,
                'password' => $payload['password']
            ]);

            $tenantUser->assignRole($adminRole);

            // Criar a company principal do tenant
            $this->createCompanyService->execute([
                'name' => $payload['company_name'] ?? $payload['name'],
                'email' => $payload['email'],
                'tenant_id' => $tenant->id,
                'is_main' => true,
                'user_id' => $tenantUser->id
            ]);

            // $authenticatedUser = $this->authenticateUserService->execute($payload['email'], $payload['password']);

            DB::commit();

            return [
                'tenant' => $tenant,
                'user' => $tenantUser,
                'token' => $tenantUser->createToken('JWT', ['tenant_id' => $tenant->id])->plainTextToken
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
