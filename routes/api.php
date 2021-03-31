<?php

use App\Http\Controllers\Api\v1\CitiesController;
use App\Http\Controllers\Api\v1\CountriesController;
use App\Http\Controllers\Api\v1\PropertiesController;
use App\Http\Controllers\Api\v1\PropertyStatusesController;
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
    Route::get('/properties', [PropertiesController::class, 'index']);
    Route::post('/properties', [PropertiesController::class, 'store']);
});

