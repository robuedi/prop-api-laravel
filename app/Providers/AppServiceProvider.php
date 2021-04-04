<?php

namespace App\Providers;

use App\Http\Services\PropertyFacadeService;
use App\Http\Services\PropertyFacadeServiceInterface;
use App\Http\Services\UserProfileStatus\UserProfileChecks;
use App\Http\Services\UserProfileStatus\UserProfileChecksInterface;
use App\Http\Services\UserProfileStatus\UserProfileStatusService;
use App\Http\Services\UserProfileStatus\UserProfileStatusServiceInterface;
use App\Http\Services\UserPropertyTypeService;
use App\Http\Services\UserPropertyTypeServiceInterface;
use App\Repositories\AgencyAddressRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\PropertyAddressRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyStatusRepositoryInterface;
use App\Repositories\Repositories\AgencyAddressRepository;
use App\Repositories\Repositories\CityRepository;
use App\Repositories\Repositories\CountryRepository;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParam;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParamInterface;
use App\Repositories\Repositories\PropertyAddressRepository;
use App\Repositories\Repositories\PropertyRepository;
use App\Repositories\Repositories\PropertyStatusRepository;
use App\Repositories\Repositories\RoleRepository;
use App\Repositories\Repositories\UserAddressRepository;
use App\Repositories\Repositories\AgencyRepository;
use App\Repositories\Repositories\UserAnnualSalaryRepository;
use App\Repositories\Repositories\UserEmploymentRepository;
use App\Repositories\Repositories\UserPropertyRepository;
use App\Repositories\Repositories\UserRentRepository;
use App\Repositories\Repositories\UserRepository;
use App\Repositories\Repositories\UserSavingRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserAddressRepositoryInterface;
use App\Repositories\AgencyRepositoryInterface;
use App\Repositories\UserEmploymentRepositoryInterface;
use App\Repositories\UserRentRepositoryInterface;
use App\Repositories\Repositories\UserTypeRepository;
use App\Repositories\UserAnnualSalaryRepositoryInterface;
use App\Repositories\UserPropertyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserSavingRepositoryInterface;
use App\Repositories\UserTypeRepositoryInterface;
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
        app()->bind(CountryRepositoryInterface::class, CountryRepository::class);
        app()->bind(CityRepositoryInterface::class, CityRepository::class);
        app()->bind(RoleRepositoryInterface::class, RoleRepository::class);
        app()->bind(PropertyStatusRepositoryInterface::class, PropertyStatusRepository::class);
        app()->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        app()->bind(PropertyAddressRepositoryInterface::class, PropertyAddressRepository::class);
        app()->bind(PropertyRepositoryIndexParamInterface::class, PropertyRepositoryIndexParam::class);
        app()->bind(UserAnnualSalaryRepositoryInterface::class, UserAnnualSalaryRepository::class);
        app()->bind(UserRentRepositoryInterface::class, UserRentRepository::class);
        app()->bind(UserEmploymentRepositoryInterface::class, UserEmploymentRepository::class);
        app()->bind(UserAddressRepositoryInterface::class, UserAddressRepository::class);
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserSavingRepositoryInterface::class, UserSavingRepository::class);
        app()->bind(AgencyRepositoryInterface::class, AgencyRepository::class);
        app()->bind(AgencyAddressRepositoryInterface::class, AgencyAddressRepository::class);

        app()->bind(UserProfileChecksInterface::class, UserProfileChecks::class);
        app()->bind(UserProfileStatusServiceInterface::class, UserProfileStatusService::class);
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
