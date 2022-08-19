<?php

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

Route::prefix('authentication')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\AuthenticationController::class, 'login']);
});

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::prefix('opportunity')->group(function () {
        Route::post('create', [\App\Http\Controllers\Api\OpportunityController::class, 'create']);
    });

    Route::prefix('company')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\CompanyController::class, 'getAll']);
    });

    Route::prefix('user')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\UserController::class, 'getAll']);
    });

    Route::prefix('customer')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\CustomerController::class, 'getByCompanyId']);
    });

    Route::prefix('country')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\CountryController::class, 'getAll']);
    });

    Route::prefix('province')->group(function () {
        Route::get('getByCountryId', [\App\Http\Controllers\Api\ProvinceController::class, 'getByCountryId']);
    });

    Route::prefix('district')->group(function () {
        Route::get('getByProvinceId', [\App\Http\Controllers\Api\DistrictController::class, 'getByProvinceId']);
    });

    Route::prefix('currency')->group(function () {
        Route::get('getAll', [\App\Http\Controllers\Api\CurrencyController::class, 'getAll']);
    });

    Route::prefix('opportunityPriority')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityPriorityController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunityAccessType')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityAccessTypeController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunityEstimatedResultType')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityEstimatedResultTypeController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunityCapacityType')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityCapacityTypeController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunityStatus')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityStatusController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunitySector')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunitySectorController::class, 'getByCompanyId']);
    });

    Route::prefix('opportunityBrand')->group(function () {
        Route::get('getByCompanyId', [\App\Http\Controllers\Api\OpportunityBrandController::class, 'getByCompanyId']);
    });
});
