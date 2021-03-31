<?php

namespace App\Providers;

use App\Http\Services\PropertyFacadeService;
use App\Http\Services\PropertyFacadeServiceInterface;
use App\Http\Services\UserPropertyTypeService;
use App\Http\Services\UserPropertyTypeServiceInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\PropertyAddressRepositoryInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyStatusRepositoryInterface;
use App\Repositories\Repositories\CityRepository;
use App\Repositories\Repositories\CountryRepository;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParam;
use App\Repositories\Repositories\Params\PropertyRepositoryIndexParamInterface;
use App\Repositories\Repositories\PropertyAddressRepository;
use App\Repositories\Repositories\PropertyRepository;
use App\Repositories\Repositories\PropertyStatusRepository;
use App\Repositories\Repositories\UserPropertyRepository;
use App\Repositories\Repositories\UserTypeRepository;
use App\Repositories\UserPropertyRepositoryInterface;
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
        app()->bind(UserTypeRepositoryInterface::class, UserTypeRepository::class);
        app()->bind(PropertyStatusRepositoryInterface::class, PropertyStatusRepository::class);
        app()->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        app()->bind(UserPropertyRepositoryInterface::class, UserPropertyRepository::class);
        app()->bind(UserPropertyTypeServiceInterface::class, UserPropertyTypeService::class);
        app()->bind(PropertyFacadeServiceInterface::class, PropertyFacadeService::class);
        app()->bind(PropertyAddressRepositoryInterface::class, PropertyAddressRepository::class);
        app()->bind(PropertyRepositoryIndexParamInterface::class, PropertyRepositoryIndexParam::class);


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
