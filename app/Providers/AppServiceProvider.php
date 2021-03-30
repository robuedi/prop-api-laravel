<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\PropertyStatusRepository;
use App\Repositories\PropertyStatusRepositoryInterface;
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
