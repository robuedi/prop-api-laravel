<?php

namespace App\Providers;

use App\Http\Services\MediaFile\MediaFileItem;
use App\Http\Services\MediaFile\MediaFileItemInterface;
use App\Http\Services\RoleUserStatus\RoleUserStatusService;
use App\Http\Services\RoleUserStatus\RoleUserStatusServiceInterface;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyStatusRepositoryInterface;
use App\Repositories\Repositories\PropertyRepository;
use App\Repositories\Repositories\PropertyStatusRepository;
use App\Repositories\Repositories\RoleRepository;
use App\Repositories\Repositories\RoleUserRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\RoleUserRepositoryInterface;
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
        app()->bind(RoleUserRepositoryInterface::class, RoleUserRepository::class);
        app()->bind(RoleRepositoryInterface::class, RoleRepository::class);

        app()->bind(RoleUserStatusServiceInterface::class, RoleUserStatusService::class);
        app()->bind(MediaFileItemInterface::class, MediaFileItem::class);
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
