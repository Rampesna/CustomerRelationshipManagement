<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\OpportunityController;
use App\Http\Controllers\Ajax\ActivityController;
use App\Http\Controllers\Ajax\CustomerController;
use App\Http\Controllers\Ajax\ManagerController;
use App\Http\Controllers\Ajax\SampleController;
use App\Http\Controllers\Ajax\SampleItemController;
use App\Http\Controllers\Ajax\OfferController;
use App\Http\Controllers\Ajax\OfferItemController;
use App\Http\Controllers\Ajax\StockController;
use App\Http\Controllers\Ajax\PriceListController;
use App\Http\Controllers\Ajax\FileController;
use App\Http\Controllers\Ajax\SocialController;
use App\Http\Controllers\Ajax\CommentController;
use App\Http\Controllers\Ajax\UserController;
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

    Route::get('offersDatatable', [OpportunityController::class, 'offersDatatable'])->name('ajax.opportunity.offersDatatable');
    Route::get('activitiesDatatable', [OpportunityController::class, 'activitiesDatatable'])->name('ajax.opportunity.activitiesDatatable');
    Route::get('samplesDatatable', [OpportunityController::class, 'samplesDatatable'])->name('ajax.opportunity.samplesDatatable');
});

Route::prefix('activity')->group(function () {
    Route::get('index', [ActivityController::class, 'index'])->name('ajax.activity.index');
    Route::get('datatable', [ActivityController::class, 'datatable'])->name('ajax.activity.datatable');
    Route::get('getRelations', [ActivityController::class, 'getRelations'])->name('ajax.activity.getRelations');
    Route::get('show', [ActivityController::class, 'show'])->name('ajax.activity.show');
    Route::post('save', [ActivityController::class, 'save'])->name('ajax.activity.save');
});


Route::prefix('customer')->group(function () {
    Route::get('index', [CustomerController::class, 'index'])->name('ajax.customer.index');
    Route::get('datatable', [CustomerController::class, 'datatable'])->name('ajax.customer.datatable');
    Route::get('show', [CustomerController::class, 'show'])->name('ajax.customer.show');
    Route::post('save', [CustomerController::class, 'save'])->name('ajax.customer.save');

    Route::get('managersDatatable', [CustomerController::class, 'managersDatatable'])->name('ajax.customer.managersDatatable');
    Route::get('offersDatatable', [CustomerController::class, 'offersDatatable'])->name('ajax.customer.offersDatatable');
    Route::get('activitiesDatatable', [CustomerController::class, 'activitiesDatatable'])->name('ajax.customer.activitiesDatatable');
    Route::get('samplesDatatable', [CustomerController::class, 'samplesDatatable'])->name('ajax.customer.samplesDatatable');
});

Route::prefix('manager')->group(function () {
    Route::get('index', [ManagerController::class, 'index'])->name('ajax.manager.index');
    Route::get('datatable', [ManagerController::class, 'datatable'])->name('ajax.manager.datatable');
    Route::get('show', [ManagerController::class, 'show'])->name('ajax.manager.show');
    Route::post('save', [ManagerController::class, 'save'])->name('ajax.manager.save');
});

Route::prefix('sample')->group(function () {
    Route::get('index', [SampleController::class, 'index'])->name('ajax.sample.index');
    Route::get('datatable', [SampleController::class, 'datatable'])->name('ajax.sample.datatable');
    Route::get('show', [SampleController::class, 'show'])->name('ajax.sample.show');
    Route::post('save', [SampleController::class, 'save'])->name('ajax.sample.save');

    Route::prefix('sampleItem')->group(function () {
        Route::get('index', [SampleItemController::class, 'index'])->name('ajax.sampleItem.index');
        Route::get('datatable', [SampleItemController::class, 'datatable'])->name('ajax.sampleItem.datatable');
        Route::get('show', [SampleItemController::class, 'show'])->name('ajax.sampleItem.show');
        Route::post('save', [SampleItemController::class, 'save'])->name('ajax.sampleItem.save');
    });
});

Route::prefix('offer')->group(function () {
    Route::get('index', [OfferController::class, 'index'])->name('ajax.offer.index');
    Route::get('datatable', [OfferController::class, 'datatable'])->name('ajax.offer.datatable');
    Route::get('show', [OfferController::class, 'show'])->name('ajax.offer.show');
    Route::post('save', [OfferController::class, 'save'])->name('ajax.offer.save');

    Route::prefix('offerItem')->group(function () {
        Route::get('index', [OfferItemController::class, 'index'])->name('ajax.offerItem.index');
        Route::get('datatable', [OfferItemController::class, 'datatable'])->name('ajax.offerItem.datatable');
        Route::get('show', [OfferItemController::class, 'show'])->name('ajax.offerItem.show');
        Route::post('save', [OfferItemController::class, 'save'])->name('ajax.offerItem.save');
        Route::delete('drop', [OfferItemController::class, 'drop'])->name('ajax.offerItem.drop');
    });
});

Route::prefix('stock')->group(function () {
    Route::get('index', [StockController::class, 'index'])->name('ajax.stock.index');
    Route::get('datatable', [StockController::class, 'datatable'])->name('ajax.stock.datatable');
    Route::get('show', [StockController::class, 'show'])->name('ajax.stock.show');
    Route::post('save', [StockController::class, 'save'])->name('ajax.stock.save');
});

Route::prefix('priceList')->group(function () {
    Route::get('index', [PriceListController::class, 'index'])->name('ajax.priceList.index');
    Route::get('datatable', [PriceListController::class, 'datatable'])->name('ajax.priceList.datatable');
    Route::get('show', [PriceListController::class, 'show'])->name('ajax.priceList.show');
    Route::post('save', [PriceListController::class, 'save'])->name('ajax.priceList.save');
});

Route::prefix('file')->group(function () {
    Route::get('index', [FileController::class, 'index'])->name('ajax.file.index');
    Route::get('show', [FileController::class, 'show'])->name('ajax.file.show');
    Route::post('save', [FileController::class, 'save'])->name('ajax.file.save');
    Route::delete('drop', [FileController::class, 'drop'])->name('ajax.file.drop');
});

Route::prefix('social')->group(function () {
    Route::get('index', [SocialController::class, 'index'])->name('ajax.social.index');
    Route::get('datatable', [SocialController::class, 'datatable'])->name('ajax.social.datatable');
    Route::get('show', [SocialController::class, 'show'])->name('ajax.social.show');
    Route::post('save', [SocialController::class, 'save'])->name('ajax.social.save');
});

Route::prefix('comment')->group(function () {
    Route::get('index', [CommentController::class, 'index'])->name('ajax.comment.index');
    Route::get('datatable', [CommentController::class, 'datatable'])->name('ajax.comment.datatable');
    Route::get('show', [CommentController::class, 'show'])->name('ajax.comment.show');
    Route::post('save', [CommentController::class, 'save'])->name('ajax.comment.save');
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('user')->group(function () {
    Route::get('index', [UserController::class, 'index'])->name('ajax.user.index');
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

    Route::get('activityMeetingReasons', [DefinitionController::class, 'activityMeetingReasons'])->name('ajax.definition.activityMeetingReasons');
    Route::get('activityPriorities', [DefinitionController::class, 'activityPriorities'])->name('ajax.definition.activityPriorities');

    Route::get('customerClasses', [DefinitionController::class, 'customerClasses'])->name('ajax.definition.customerClasses');
    Route::get('customerTypes', [DefinitionController::class, 'customerTypes'])->name('ajax.definition.customerTypes');
    Route::get('customerReferences', [DefinitionController::class, 'customerReferences'])->name('ajax.definition.customerReferences');

    Route::get('managerDepartments', [DefinitionController::class, 'managerDepartments'])->name('ajax.definition.managerDepartments');
    Route::get('managerTitles', [DefinitionController::class, 'managerTitles'])->name('ajax.definition.managerTitles');

    Route::get('cargoCompanies', [DefinitionController::class, 'cargoCompanies'])->name('ajax.definition.cargoCompanies');
    Route::get('sampleStatuses', [DefinitionController::class, 'sampleStatuses'])->name('ajax.definition.sampleStatuses');

    Route::get('offerPayTypes', [DefinitionController::class, 'offerPayTypes'])->name('ajax.definition.offerPayTypes');
    Route::get('offerDeliveryTypes', [DefinitionController::class, 'offerDeliveryTypes'])->name('ajax.definition.offerDeliveryTypes');
    Route::get('offerStatuses', [DefinitionController::class, 'offerStatuses'])->name('ajax.definition.offerStatuses');

    Route::get('unitTypes', [DefinitionController::class, 'unitTypes'])->name('ajax.definition.unitTypes');
    Route::get('stockTypes', [DefinitionController::class, 'stockTypes'])->name('ajax.definition.stockTypes');
    Route::get('stockStatuses', [DefinitionController::class, 'stockStatuses'])->name('ajax.definition.stockStatuses');

    Route::get('priceListStatuses', [DefinitionController::class, 'priceListStatuses'])->name('ajax.definition.priceListStatuses');
});
