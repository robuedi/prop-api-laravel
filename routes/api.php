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
    Route::get('/cities', [CitiesController::class, 'index']);
    Route::get('/property-statuses', [PropertyStatusesController::class, 'index']);

    //properties
    Route::get('/properties', [PropertiesController::class, 'index']);
    Route::get('/properties/{property}', [PropertiesController::class, 'show']);

    //properties address
    Route::get('/properties/{property}/address', [PropertyAddressesController::class, 'showForProperty']);

    Route::get('/agencies/{agency}/address', [AgencyAddressesController::class, 'showForAgency']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/users/{user}/properties', [PropertiesController::class, 'indexForUser']);
        Route::get('/users/{user}/property-applications', [PropertiesController::class, 'indexForUserApplications']);

        Route::post('/users/{user}/roles', [RolesController::class, 'getForUser']);

        Route::post('/users/{user}/properties', [PropertiesController::class, 'storeForUser']);
        Route::post('/users/{user}/properties/{property}/addresses', [PropertyAddressesController::class, 'storeForUserProperty']);
        Route::get('/users/{user}/properties/{property}/addresses', [PropertyAddressesController::class, 'showForUserProperty']);

        Route::post('/users/{user}/annual-salaries', [AnnualSalariesController::class, 'storeForUser']);
        Route::get('/users/{user}/annual-salaries', [AnnualSalariesController::class, 'showForUser']);

        Route::post('/users/{user}/rents', [RentsController::class, 'storeForUser']);
        Route::get('/users/{user}/rents', [RentsController::class, 'showForUser']);

        Route::post('/users/{user}/employments', [EmploymentController::class, 'storeForUser']);
        Route::get('/users/{user}/employments', [EmploymentController::class, 'showForUser']);

        Route::post('/users/{user}/savings', [SavingsController::class, 'storeForUser']);
        Route::get('/users/{user}/savings', [SavingsController::class, 'showForUser']);

//        Route::get('/roles-users/', [RolesUsersController::class, 'showForUser']);

        Route::post('/users/{user}/addresses', [UserAddressController::class, 'storeForUser']);
        Route::get('/users/{user}/addresses', [UserAddressController::class, 'showForUser']);

        Route::post('/users/{user}/agencies', [AgenciesController::class, 'storeForUser']);
        Route::get('/users/{user}/agencies', [AgenciesController::class, 'showForUser']);
        Route::post('/users/{user}/agencies/{agency}/addresses', [AgencyAddressesController::class, 'storeForUserAgency']);
        Route::get('/users/{user}/agencies/{agency}/addresses', [AgencyAddressesController::class, 'showForUserAgency']);

        Route::get('/roles', [RolesController::class, 'index']);

        Route::get('/users/{user}/roles-users/{role_user}/check-complete', [RolesUsersController::class, 'checkRoleUserComplete']);
        Route::post('/users/{user}/roles-users', [RolesUsersController::class, 'storeForUser']);
    });
});

