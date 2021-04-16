<?php

namespace App\Providers;

use App\Http\Services\RoleUserStatus\RoleUserChecks;
use App\Http\Services\RoleUserStatus\RoleUserChecksInterface;
use App\Http\Services\RoleUserStatus\RoleUserStatusService;
use App\Http\Services\RoleUserStatus\RoleUserStatusServiceInterface;
use App\Repositories\AgencyAddressRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\PropertyAddressRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyStatusRepositoryInterface;
use App\Repositories\Repositories\AgencyAddressRepository;
use App\Repositories\Repositories\PropertyAddressRepository;
use App\Repositories\Repositories\PropertyRepository;
use App\Repositories\Repositories\PropertyStatusRepository;
use App\Repositories\Repositories\RoleRepository;
use App\Repositories\Repositories\RoleUserRepository;
use App\Repositories\Repositories\UserAddressRepository;
use App\Repositories\Repositories\AgencyRepository;
use App\Repositories\Repositories\UserAnnualSalaryRepository;
use App\Repositories\Repositories\UserEmploymentRepository;
use App\Repositories\Repositories\UserRentRepository;
use App\Repositories\Repositories\UserSavingRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\RoleUserRepositoryInterface;
use App\Repositories\UserAddressRepositoryInterface;
use App\Repositories\AgencyRepositoryInterface;
use App\Repositories\UserEmploymentRepositoryInterface;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(PropertyStatusRepositoryInterface::class, PropertyStatusRepository::class);
        app()->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        app()->bind(PropertyAddressRepositoryInterface::class, PropertyAddressRepository::class);
        app()->bind(UserAnnualSalaryRepositoryInterface::class, UserAnnualSalaryRepository::class);
        app()->bind(UserRentRepositoryInterface::class, UserRentRepository::class);
        app()->bind(UserEmploymentRepositoryInterface::class, UserEmploymentRepository::class);
        app()->bind(UserAddressRepositoryInterface::class, UserAddressRepository::class);
        app()->bind(RoleUserRepositoryInterface::class, RoleUserRepository::class);
        app()->bind(UserSavingRepositoryInterface::class, UserSavingRepository::class);
        app()->bind(AgencyRepositoryInterface::class, AgencyRepository::class);
        app()->bind(AgencyAddressRepositoryInterface::class, AgencyAddressRepository::class);
        app()->bind(RoleRepositoryInterface::class, RoleRepository::class);

        app()->bind(RoleUserChecksInterface::class, RoleUserChecks::class);
        app()->bind(RoleUserStatusServiceInterface::class, RoleUserStatusService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
