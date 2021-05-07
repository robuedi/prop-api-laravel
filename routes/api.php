<?php

use App\Http\Controllers\Api\v1\AgencyAddressesController;
use App\Http\Controllers\Api\v1\CountriesController;
use App\Http\Controllers\Api\v1\Properties\PropertyApplicationsController;
use App\Http\Controllers\Api\v1\Properties\PropertiesController;
use App\Http\Controllers\Api\v1\Properties\RoleUserPropertiesController;
use App\Http\Controllers\Api\v1\PropertyAddressesController;
use App\Http\Controllers\Api\v1\PropertyStatusesController;
use App\Http\Controllers\Api\v1\RentsController;
use App\Http\Controllers\Api\v1\Roles\RolesController;
use App\Http\Controllers\Api\v1\Roles\UserRolesController;
use App\Http\Controllers\Api\v1\RoleUserAddressesController;
use App\Http\Controllers\Api\v1\AgenciesController;
use App\Http\Controllers\Api\v1\AnnualSalariesController;
use App\Http\Controllers\Api\v1\EmploymentController;
use App\Http\Controllers\Api\v1\SavingsController;
use App\Http\Controllers\Api\v1\RolesUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load([
        'activeUserRole' => function($query){
            $query->with('role:id,name');},
        'userRole' => function($query){
            $query->with('role:id,name');
    }]);
});

Auth::routes();

Route::prefix('v1')->group(function (){

    Route::resource('/countries', CountriesController::class, ['only' => ['index']]);
    Route::resource('/property-statuses', PropertyStatusesController::class, ['only' => ['index']]);

    //properties
    Route::resource('/properties', PropertiesController::class, ['only' => ['index', 'show']]);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::resource('roles', RolesController::class, ['only' => ['index']]);

        Route::resource('agencies/{agency}/addresses', AgencyAddressesController::class, ['only' => ['index', 'store']]);

        Route::resource('properties/{property}/addresses', PropertyAddressesController::class, ['only' => ['index', 'store']]);

        Route::resource('roles-users', RolesUsersController::class, ['only' => ['update', 'store']]);

        Route::prefix('users/{user}')->group(function (){
            Route::resource('roles', UserRolesController::class, ['only' => ['index']]);
        });

        Route::group(['prefix' => 'roles-users/{role_user}', 'middleware' => ['role-user-authorization']], function (){

            //property applications
            Route::resource('property-applications', PropertyApplicationsController::class, ['only' => ['index', 'store']]);

            //properties
            Route::resource('properties', RoleUserPropertiesController::class, ['only' => ['index', 'store']]);

            //role user address
            Route::resource('addresses', RoleUserAddressesController::class, ['only' => ['index', 'store']]);

            //annual salaries
            Route::resource('annual-salaries', AnnualSalariesController::class, ['only' => ['index', 'store']]);

            //rent
            Route::resource('rents', RentsController::class, ['only' => ['index', 'store']]);

            //employment
            Route::resource('employments', EmploymentController::class, ['only' => ['index', 'store']]);

            //savings
            Route::resource('savings', SavingsController::class, ['only' => ['index', 'store']]);

            //agencies
            Route::resource('agencies', AgenciesController::class, ['only' => ['index', 'store']]);

        });
    });
});

