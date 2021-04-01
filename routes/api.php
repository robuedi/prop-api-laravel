<?php

use App\Http\Controllers\Api\v1\AgencyAddressesController;
use App\Http\Controllers\Api\v1\CitiesController;
use App\Http\Controllers\Api\v1\CountriesController;
use App\Http\Controllers\Api\v1\PropertiesController;
use App\Http\Controllers\Api\v1\PropertyStatusesController;
use App\Http\Controllers\Api\v1\UserAddressController;
use App\Http\Controllers\Api\v1\AgenciesController;
use App\Http\Controllers\Api\v1\UserAnnualSalariesController;
use App\Http\Controllers\Api\v1\UserEmploymentController;
use App\Http\Controllers\Api\v1\UserRentsController;
use App\Http\Controllers\Api\v1\UserSavingsController;
use App\Http\Controllers\Api\v1\UsersController;
use App\Http\Controllers\Api\v1\UserTypesController;
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
    return $request->user();
});

Auth::routes();

Route::prefix('v1')->group(function (){
    Route::get('/countries', [CountriesController::class, 'index']);
    Route::get('/cities', [CitiesController::class, 'index']);
    Route::get('/user-types', [UserTypesController::class, 'index']);
    Route::get('/property-statuses', [PropertyStatusesController::class, 'index']);

    //properties
    Route::get('/properties', [PropertiesController::class, 'index']);
    Route::post('/properties', [PropertiesController::class, 'store']);
    Route::get('/properties/{property}', [PropertiesController::class, 'show']);

    //properties address
    Route::get('/properties/{property}/address', [PropertiesController::class, 'showPropertyAddress']);

    Route::post('/annual-salaries', [UserAnnualSalariesController::class, 'store']);
    Route::get('/annual-salaries/current-user', [UserAnnualSalariesController::class, 'showCurrentUser']);

    Route::post('/user-rent', [UserRentsController::class, 'store']);
    Route::get('/user-rent/current-user', [UserRentsController::class, 'showCurrentUser']);

    Route::post('/user-employment', [UserEmploymentController::class, 'store']);
    Route::get('/user-employment/current-user', [UserEmploymentController::class, 'showCurrentUser']);

    Route::post('/user-savings', [UserSavingsController::class, 'store']);
    Route::get('/user-savings/current-user', [UserSavingsController::class, 'showCurrentUser']);

    Route::post('/user-address', [UserAddressController::class, 'store']);
    Route::get('/user-address/current-user', [UserAddressController::class, 'showCurrentUser']);

    Route::post('/agencies', [AgenciesController::class, 'store']);
    Route::get('/agencies/current-user', [AgenciesController::class, 'showCurrentUser']);
    Route::get('/agencies/{agency}/address', [AgencyAddressesController::class, 'showForAgency']);
    Route::post('/agencies/{agency}/address', [AgencyAddressesController::class, 'storeForAgency']);

    Route::get('/users/check-profile-completed', [UsersController::class, 'checkUserProfileComplete']);

});

