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
        Route::get('/users/{user}/properties', [PropertiesController::class, 'indexForUser']);
        Route::post('/users/{user}/properties', [PropertiesController::class, 'storeForUser']);
        Route::get('/users/{user}/property-applications', [PropertiesController::class, 'indexForUserApplications']);

        Route::post('users/{user}/roles', [RolesController::class, 'getForUser']);
        Route::post('users/{user}/roles-users', [RolesUsersController::class, 'storeForUser']);

        Route::put('roles-users/{role_user}', [RolesUsersController::class, 'update']);

        Route::get('roles', [RolesController::class, 'index']);

        Route::post('agencies/{agency}/addresses', [AgencyAddressesController::class, 'storeForAgency']);
        Route::get('agencies/{agency}/addresses', [AgencyAddressesController::class, 'showForAgency']);

        //role user address
        Route::post('roles-users/{role_user}/addresses', [UserAddressController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/addresses', [UserAddressController::class, 'indexForRoleUser']);

        Route::post('properties/{property}/addresses', [PropertyAddressesController::class, 'storeForUserProperty']);
        Route::get('properties/{property}/addresses', [PropertyAddressesController::class, 'showForUserProperty']);

        Route::post('roles-users/{role_user}/annual-salaries', [AnnualSalariesController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/annual-salaries', [AnnualSalariesController::class, 'indexForRoleUser']);

        //rent
        Route::post('roles-users/{role_user}/rents', [RentsController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/rents', [RentsController::class, 'indexForRoleUser']);

        //employment
        Route::post('roles-users/{role_user}/employments', [EmploymentController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/employments', [EmploymentController::class, 'indexForRoleUser']);

        //savings
        Route::post('roles-users/{role_user}/savings', [SavingsController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/savings', [SavingsController::class, 'indexForRoleUser']);

        //agencies
        Route::post('roles-users/{role_user}/agencies', [AgenciesController::class, 'storeForRoleUser']);
        Route::get('roles-users/{role_user}/agencies', [AgenciesController::class, 'indexForRoleUser']);
    });
});

