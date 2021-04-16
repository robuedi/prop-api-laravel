<?php

use App\Http\Controllers\Api\v1\AgencyAddressesController;
use App\Http\Controllers\Api\v1\CitiesController;
use App\Http\Controllers\Api\v1\CountriesController;
use App\Http\Controllers\Api\v1\PropertiesController;
use App\Http\Controllers\Api\v1\PropertyAddressesController;
use App\Http\Controllers\Api\v1\PropertyStatusesController;
use App\Http\Controllers\Api\v1\RentsController;
use App\Http\Controllers\Api\v1\RolesController;
use App\Http\Controllers\Api\v1\UserAddressController;
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
    return $request->user()->load(['userRole' => function($query){
        $query->with('role:id,name');
    }]);
});

Auth::routes();

Route::prefix('v1')->group(function (){

    Route::get('/countries', [CountriesController::class, 'index']);
    Route::get('/property-statuses', [PropertyStatusesController::class, 'index']);

    //properties
    Route::get('/properties', [PropertiesController::class, 'index']);
    Route::get('/properties/{property:slug}', [PropertiesController::class, 'show']);

    //properties address
    Route::get('/properties/{property}/address', [PropertyAddressesController::class, 'showForProperty']);

    Route::get('/agencies/{agency}/address', [AgencyAddressesController::class, 'showForAgency']);

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('roles', [RolesController::class, 'index']);

        Route::post('agencies/{agency}/addresses', [AgencyAddressesController::class, 'store']);
        Route::get('agencies/{agency}/addresses', [AgencyAddressesController::class, 'show']);

        Route::post('properties/{property}/addresses', [PropertyAddressesController::class, 'store']);
        Route::get('properties/{property}/addresses', [PropertyAddressesController::class, 'index']);

        Route::prefix('users/{user}')->group(function (){

            Route::post('properties', [PropertiesController::class, 'store']);
            Route::get('properties-owned', [PropertiesController::class, 'indexOwned']);
            Route::get('property-applications', [PropertiesController::class, 'indexApplications']);

            Route::post('roles', [RolesController::class, 'indexUser']);
            Route::post('roles-users', [RolesUsersController::class, 'store']);

        });

        Route::put('roles-users/{role_user}', [RolesUsersController::class, 'update']);

        Route::prefix('roles-users/{role_user}')->group(function (){

            //role user address
            Route::post('addresses', [UserAddressController::class, 'store']);
            Route::get('addresses', [UserAddressController::class, 'index']);

            //annual salaries
            Route::post('annual-salaries', [AnnualSalariesController::class, 'store']);
            Route::get('annual-salaries', [AnnualSalariesController::class, 'index']);

            //rent
            Route::post('rents', [RentsController::class, 'store']);
            Route::get('rents', [RentsController::class, 'index']);

            //employment
            Route::post('employments', [EmploymentController::class, 'store']);
            Route::get('employments', [EmploymentController::class, 'index']);

            //savings
            Route::post('savings', [SavingsController::class, 'store']);
            Route::get('savings', [SavingsController::class, 'index']);

            //agencies
            Route::post('agencies', [AgenciesController::class, 'store']);
            Route::get('agencies', [AgenciesController::class, 'index']);
            
        });
    });
});

