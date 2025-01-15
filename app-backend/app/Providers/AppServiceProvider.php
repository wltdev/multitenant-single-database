<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\CentralUser;
use App\Models\City;
use App\Models\Client;
use App\Models\Company;
use App\Models\KanbanBoard;
use App\Models\KanbanBoardColumn;
use App\Models\Lead;
use App\Models\Permission;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Province;
use App\Models\Tenant;
use App\Models\TenantPlan;
use App\Models\User;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\CentralUser\CentralUserRepository;
use App\Repositories\CentralUser\CentralUserRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\KanbanBoard\KanbanBoardRepository;
use App\Repositories\KanbanBoard\KanbanBoardRepositoryInterface;
use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepository;
use App\Repositories\KanbanBoardColumn\KanbanBoardColumnRepositoryInterface;
use App\Repositories\Lead\LeadRepository;
use App\Repositories\Lead\LeadRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\ProjectMember\ProjectMemberRepository;
use App\Repositories\ProjectMember\ProjectMemberRepositoryInterface;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Tenant\TenantRepository;
use App\Repositories\Tenant\TenantRepositoryInterface;
use App\Repositories\TenantPlan\TenantPlanRepository;
use App\Repositories\TenantPlan\TenantPlanRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TenantRepositoryInterface::class, function ($app) {
            return new TenantRepository($app->make(Tenant::class));
        });

        $this->app->bind(
            CentralUserRepositoryInterface::class,
            function ($app) {
                return new CentralUserRepository($app->make(CentralUser::class));
            }
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            function ($app) {
                return new UserRepository($app->make(User::class));
            }
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            function ($app) {
                return new PermissionRepository(new Permission());
            }
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            function ($app) {
                return new RoleRepository($app->make(Role::class));
            }
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            function ($app) {
                return new CompanyRepository($app->make(Company::class));
            }
        );

        $this->app->bind(
            ProvinceRepositoryInterface::class,
            function ($app) {
                return new ProvinceRepository($app->make(Province::class));
            }
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            function ($app) {
                return new CityRepository($app->make(City::class));
            }
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            function ($app) {
                return new AddressRepository($app->make(Address::class));
            }
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            function ($app) {
                return new ClientRepository($app->make(Client::class));
            }
        );

        $this->app->bind(
            TenantPlanRepositoryInterface::class,
            function ($app) {
                return new TenantPlanRepository($app->make(TenantPlan::class));
            }
        );

        $this->app->bind(
            KanbanBoardRepositoryInterface::class,
            function ($app) {
                return new KanbanBoardRepository($app->make(KanbanBoard::class));
            }
        );

        $this->app->bind(
            KanbanBoardColumnRepositoryInterface::class,
            function ($app) {
                return new KanbanBoardColumnRepository($app->make(KanbanBoardColumn::class));
            }
        );

        $this->app->bind(
            LeadRepositoryInterface::class,
            function ($app) {
                return new LeadRepository($app->make(Lead::class));
            }
        );

        $this->app->bind(
            ProjectRepositoryInterface::class,
            function ($app) {
                return new ProjectRepository($app->make(Project::class));
            }
        );
        $this->app->bind(
            ProjectMemberRepositoryInterface::class,
            function ($app) {
                return new ProjectMemberRepository($app->make(ProjectMember::class));
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
