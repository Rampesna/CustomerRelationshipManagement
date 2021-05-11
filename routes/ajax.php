<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\OpportunityController;
use App\Http\Controllers\Ajax\UserController;
use App\Http\Controllers\Ajax\CustomerController;
use App\Http\Controllers\Ajax\CountryController;
use App\Http\Controllers\Ajax\ProvinceController;
use App\Http\Controllers\Ajax\DistrictController;
use App\Http\Controllers\Ajax\DefinitionController;

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

Route::prefix('opportunity')->group(function () {
    Route::get('index', [OpportunityController::class, 'index'])->name('ajax.opportunity.index');
    Route::get('datatable', [OpportunityController::class, 'datatable'])->name('ajax.opportunity.datatable');
    Route::get('show', [OpportunityController::class, 'show'])->name('ajax.opportunity.show');
    Route::post('save', [OpportunityController::class, 'save'])->name('ajax.opportunity.save');
});

Route::prefix('user')->group(function () {
    Route::get('index', [UserController::class, 'index'])->name('ajax.user.index');
});

Route::prefix('customer')->group(function () {
    Route::get('index', [CustomerController::class, 'index'])->name('ajax.customer.index');
});

Route::prefix('country')->group(function () {
    Route::get('index', [CountryController::class, 'index'])->name('ajax.country.index');
});

Route::prefix('province')->group(function () {
    Route::get('index', [ProvinceController::class, 'index'])->name('ajax.province.index');
});

Route::prefix('district')->group(function () {
    Route::get('index', [DistrictController::class, 'index'])->name('ajax.district.index');
});

Route::prefix('definition')->group(function () {
    Route::get('opportunityPriorities', [DefinitionController::class, 'opportunityPriorities'])->name('ajax.definition.opportunityPriorities');
    Route::get('opportunityAccessTypes', [DefinitionController::class, 'opportunityAccessTypes'])->name('ajax.definition.opportunityAccessTypes');
    Route::get('opportunityEstimatedResultTypes', [DefinitionController::class, 'opportunityEstimatedResultTypes'])->name('ajax.definition.opportunityEstimatedResultTypes');
    Route::get('opportunityCapacityTypes', [DefinitionController::class, 'opportunityCapacityTypes'])->name('ajax.definition.opportunityCapacityTypes');
    Route::get('opportunityStatuses', [DefinitionController::class, 'opportunityStatuses'])->name('ajax.definition.opportunityStatuses');
});
