<?php

use App\Http\Controllers\Api\v1\AgencyAddressesController;
use App\Http\Controllers\Api\v1\CitiesController;
use App\Http\Controllers\Api\v1\CountriesController;
use App\Http\Controllers\Api\v1\PropertiesController;
use App\Http\Controllers\Api\v1\PropertyStatusesController;
use App\Http\Controllers\Api\v1\RentsController;
use App\Http\Controllers\Api\v1\UserAddressController;
use App\Http\Controllers\Api\v1\AgenciesController;
use App\Http\Controllers\Api\v1\AnnualSalariesController;
use App\Http\Controllers\Api\v1\EmploymentController;
use App\Http\Controllers\Api\v1\SavingsController;
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
    Route::get('/properties/{property}', [PropertiesController::class, 'show']);

    //properties address
    Route::get('/properties/{property}/address', [PropertiesController::class, 'showPropertyAddress']);

    Route::get('/agencies/{agency}/address', [AgencyAddressesController::class, 'showForAgency']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/properties', [PropertiesController::class, 'store']);

        Route::post('/users/{user}/annual-salaries', [AnnualSalariesController::class, 'storeForUser']);
        Route::get('/users/{user}/annual-salaries', [AnnualSalariesController::class, 'showForUser']);

        Route::post('/users/{user}/rents', [RentsController::class, 'storeForUser']);
        Route::get('/users/{user}/rents', [RentsController::class, 'showForUser']);

        Route::post('/users/{user}/employments', [EmploymentController::class, 'storeForUser']);
        Route::get('/users/{user}/employments', [EmploymentController::class, 'showForUser']);

        Route::post('/users/{user}/savings', [SavingsController::class, 'storeForUser']);
        Route::get('/users/{user}/savings', [SavingsController::class, 'showForUser']);

        Route::post('/users/{user}/addresses', [UserAddressController::class, 'storeForUser']);
        Route::get('/users/{user}/addresses', [UserAddressController::class, 'showForUser']);

        Route::post('/users/{user}/agencies', [AgenciesController::class, 'storeForUser']);
        Route::get('/users/{user}/agencies', [AgenciesController::class, 'showForUser']);
        Route::post('/users/{user}/agencies/{agency}/address', [AgencyAddressesController::class, 'storeForUserAgency']);

        Route::get('/users/check-profile-completed', [UsersController::class, 'checkUserProfileComplete']);
    });
});

