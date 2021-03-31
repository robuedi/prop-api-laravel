<?php

namespace App\Providers;

use App\Http\Services\PropertyService;
use App\Http\Services\PropertyServiceInterface;
use App\Http\Services\UserPropertyTypeService;
use App\Http\Services\UserPropertyTypeServiceInterface;
use App\Repositories\CityRepository;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\PropertyRepository;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyStatusRepository;
use App\Repositories\PropertyStatusRepositoryInterface;
use App\Repositories\UserPropertyRepository;
use App\Repositories\UserPropertyRepositoryInterface;
use App\Repositories\UserTypeRepository;
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
        app()->bind(PropertyServiceInterface::class, PropertyService::class);


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
