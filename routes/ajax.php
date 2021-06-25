<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\DashboardController;
use App\Http\Controllers\Ajax\OpportunityController;
use App\Http\Controllers\Ajax\ActivityController;
use App\Http\Controllers\Ajax\CustomerController;
use App\Http\Controllers\Ajax\ManagerController;
use App\Http\Controllers\Ajax\SampleController;
use App\Http\Controllers\Ajax\SampleItemController;
use App\Http\Controllers\Ajax\PriceListItemController;
use App\Http\Controllers\Ajax\OfferController;
use App\Http\Controllers\Ajax\OfferItemController;
use App\Http\Controllers\Ajax\StockController;
use App\Http\Controllers\Ajax\PriceListController;
use App\Http\Controllers\Ajax\FileController;
use App\Http\Controllers\Ajax\SocialController;
use App\Http\Controllers\Ajax\CommentController;
use App\Http\Controllers\Ajax\NoteController;
use App\Http\Controllers\Ajax\MeetingController;
use App\Http\Controllers\Ajax\UserController;
use App\Http\Controllers\Ajax\CompanyController;
use App\Http\Controllers\Ajax\RoleController;
use App\Http\Controllers\Ajax\PermissionController;
use App\Http\Controllers\Ajax\CountryController;
use App\Http\Controllers\Ajax\ProvinceController;
use App\Http\Controllers\Ajax\DistrictController;
use App\Http\Controllers\Ajax\DefinitionController;
use App\Http\Controllers\Ajax\ProfileController;
use App\Http\Controllers\Ajax\TargetController;
use App\Http\Controllers\Ajax\SettingController;

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

Route::prefix('dashboard')->group(function () {
    Route::get('index', [DashboardController::class, 'index'])->name('ajax.dashboard.index');
    Route::get('calendar', [DashboardController::class, 'calendar'])->name('ajax.dashboard.calendar');
});

Route::prefix('opportunity')->group(function () {
    Route::get('index', [OpportunityController::class, 'index'])->name('ajax.opportunity.index');
    Route::get('datatable', [OpportunityController::class, 'datatable'])->name('ajax.opportunity.datatable');
    Route::get('reportDatatable', [OpportunityController::class, 'reportDatatable'])->name('ajax.opportunity.reportDatatable');
    Route::get('show', [OpportunityController::class, 'show'])->name('ajax.opportunity.show');
    Route::get('showDetail', [OpportunityController::class, 'showDetail'])->name('ajax.opportunity.showDetail');
    Route::post('save', [OpportunityController::class, 'save'])->name('ajax.opportunity.save');
    Route::post('import', [OpportunityController::class, 'import'])->name('ajax.opportunity.import');
    Route::delete('drop', [OpportunityController::class, 'drop'])->name('ajax.opportunity.drop');

    Route::get('offersDatatable', [OpportunityController::class, 'offersDatatable'])->name('ajax.opportunity.offersDatatable');
    Route::get('activitiesDatatable', [OpportunityController::class, 'activitiesDatatable'])->name('ajax.opportunity.activitiesDatatable');
    Route::get('samplesDatatable', [OpportunityController::class, 'samplesDatatable'])->name('ajax.opportunity.samplesDatatable');
});

Route::prefix('activity')->group(function () {
    Route::get('index', [ActivityController::class, 'index'])->name('ajax.activity.index');
    Route::get('datatable', [ActivityController::class, 'datatable'])->name('ajax.activity.datatable');
    Route::get('reportDatatable', [ActivityController::class, 'reportDatatable'])->name('ajax.activity.reportDatatable');
    Route::get('getRelations', [ActivityController::class, 'getRelations'])->name('ajax.activity.getRelations');
    Route::get('show', [ActivityController::class, 'show'])->name('ajax.activity.show');
    Route::post('save', [ActivityController::class, 'save'])->name('ajax.activity.save');
    Route::delete('drop', [ActivityController::class, 'drop'])->name('ajax.activity.drop');
});

Route::prefix('customer')->group(function () {
    Route::get('index', [CustomerController::class, 'index'])->name('ajax.customer.index');
    Route::get('datatable', [CustomerController::class, 'datatable'])->name('ajax.customer.datatable');
    Route::get('show', [CustomerController::class, 'show'])->name('ajax.customer.show');
    Route::post('save', [CustomerController::class, 'save'])->name('ajax.customer.save');
    Route::delete('drop', [CustomerController::class, 'drop'])->name('ajax.customer.drop');

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
    Route::delete('drop', [ManagerController::class, 'drop'])->name('ajax.manager.drop');
});

Route::prefix('sample')->group(function () {
    Route::get('index', [SampleController::class, 'index'])->name('ajax.sample.index');
    Route::get('datatable', [SampleController::class, 'datatable'])->name('ajax.sample.datatable');
    Route::get('show', [SampleController::class, 'show'])->name('ajax.sample.show');
    Route::post('save', [SampleController::class, 'save'])->name('ajax.sample.save');
    Route::delete('drop', [SampleController::class, 'drop'])->name('ajax.sample.drop');

    Route::prefix('sampleItem')->group(function () {
        Route::get('index', [SampleItemController::class, 'index'])->name('ajax.sampleItem.index');
        Route::get('datatable', [SampleItemController::class, 'datatable'])->name('ajax.sampleItem.datatable');
        Route::get('show', [SampleItemController::class, 'show'])->name('ajax.sampleItem.show');
        Route::post('save', [SampleItemController::class, 'save'])->name('ajax.sampleItem.save');
        Route::delete('drop', [SampleItemController::class, 'drop'])->name('ajax.sampleItem.drop');
    });
});

Route::prefix('offer')->group(function () {
    Route::get('index', [OfferController::class, 'index'])->name('ajax.offer.index');
    Route::get('datatable', [OfferController::class, 'datatable'])->name('ajax.offer.datatable');
    Route::get('show', [OfferController::class, 'show'])->name('ajax.offer.show');
    Route::post('save', [OfferController::class, 'save'])->name('ajax.offer.save');
    Route::delete('drop', [OfferController::class, 'drop'])->name('ajax.offer.drop');
    Route::get('downloadPDF', [OfferController::class, 'downloadPDF'])->name('ajax.offer.downloadPDF');
    Route::post('sendEmail', [OfferController::class, 'sendEmail'])->name('ajax.offer.sendEmail');

    Route::get('getCurrency', [OfferController::class, 'getCurrency'])->name('ajax.offer.getCurrency');

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
    Route::delete('drop', [StockController::class, 'drop'])->name('ajax.stock.drop');
});

Route::prefix('priceList')->group(function () {
    Route::get('index', [PriceListController::class, 'index'])->name('ajax.priceList.index');
    Route::get('datatable', [PriceListController::class, 'datatable'])->name('ajax.priceList.datatable');
    Route::get('show', [PriceListController::class, 'show'])->name('ajax.priceList.show');
    Route::post('save', [PriceListController::class, 'save'])->name('ajax.priceList.save');
    Route::delete('drop', [PriceListController::class, 'drop'])->name('ajax.priceList.drop');
    Route::post('copy', [PriceListController::class, 'copy'])->name('ajax.priceList.copy');
    Route::get('downloadPDF', [PriceListController::class, 'downloadPDF'])->name('ajax.priceList.downloadPDF');
    Route::post('sendEmail', [PriceListController::class, 'sendEmail'])->name('ajax.priceList.sendEmail');

    Route::prefix('priceListItem')->group(function () {
        Route::get('index', [PriceListItemController::class, 'index'])->name('ajax.priceListItem.index');
        Route::get('datatable', [PriceListItemController::class, 'datatable'])->name('ajax.priceListItem.datatable');
        Route::get('show', [PriceListItemController::class, 'show'])->name('ajax.priceListItem.show');
        Route::post('save', [PriceListItemController::class, 'save'])->name('ajax.priceListItem.save');
        Route::delete('drop', [PriceListItemController::class, 'drop'])->name('ajax.priceListItem.drop');
    });
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
    Route::delete('drop', [SocialController::class, 'drop'])->name('ajax.social.drop');
});

Route::prefix('comment')->group(function () {
    Route::get('index', [CommentController::class, 'index'])->name('ajax.comment.index');
    Route::get('datatable', [CommentController::class, 'datatable'])->name('ajax.comment.datatable');
    Route::get('show', [CommentController::class, 'show'])->name('ajax.comment.show');
    Route::post('save', [CommentController::class, 'save'])->name('ajax.comment.save');
    Route::delete('drop', [CommentController::class, 'drop'])->name('ajax.comment.drop');
});

Route::prefix('note')->group(function () {
    Route::get('show', [NoteController::class, 'show'])->name('ajax.note.show');
    Route::post('save', [NoteController::class, 'save'])->name('ajax.note.save');
    Route::delete('drop', [NoteController::class, 'drop'])->name('ajax.note.drop');
});

Route::prefix('meeting')->group(function () {
    Route::get('show', [MeetingController::class, 'show'])->name('ajax.meeting.show');
    Route::post('save', [MeetingController::class, 'save'])->name('ajax.meeting.save');
    Route::delete('drop', [MeetingController::class, 'drop'])->name('ajax.meeting.drop');
});

Route::prefix('user')->group(function () {
    Route::get('all', [UserController::class, 'all'])->name('ajax.user.all');
    Route::get('index', [UserController::class, 'index'])->name('ajax.user.index');
    Route::get('datatable', [UserController::class, 'datatable'])->name('ajax.user.datatable');
    Route::get('show', [UserController::class, 'show'])->name('ajax.user.show');
    Route::post('save', [UserController::class, 'save'])->name('ajax.user.save');
    Route::delete('drop', [UserController::class, 'drop'])->name('ajax.user.drop');

    Route::get('emailControl', [UserController::class, 'emailControl'])->name('ajax.user.emailControl');
});

Route::prefix('role')->group(function () {
    Route::get('index', [RoleController::class, 'index'])->name('ajax.role.index');
    Route::get('datatable', [RoleController::class, 'datatable'])->name('ajax.role.datatable');
    Route::get('show', [RoleController::class, 'show'])->name('ajax.role.show');
    Route::post('save', [RoleController::class, 'save'])->name('ajax.role.save');
    Route::delete('drop', [RoleController::class, 'drop'])->name('ajax.role.drop');
});

Route::prefix('profile')->group(function () {
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('ajax.profile.updateProfile');
    Route::post('updatePassword', [ProfileController::class, 'updatePassword'])->name('ajax.profile.updatePassword');
});

Route::prefix('target')->group(function () {
    Route::get('index', [TargetController::class, 'index'])->name('ajax.target.index');
    Route::get('datatable', [TargetController::class, 'datatable'])->name('ajax.target.datatable');
    Route::get('show', [TargetController::class, 'show'])->name('ajax.target.show');
    Route::post('save', [TargetController::class, 'save'])->name('ajax.target.save');
    Route::delete('drop', [TargetController::class, 'drop'])->name('ajax.target.drop');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::prefix('permission')->group(function () {
    Route::get('index', [PermissionController::class, 'index'])->name('ajax.permission.index');
});

Route::prefix('company')->group(function () {
    Route::get('index', [CompanyController::class, 'index'])->name('ajax.company.index');
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

Route::prefix('setting')->group(function () {
    Route::get('show', [SettingController::class, 'show'])->name('ajax.setting.show');
    Route::post('updateMailSettings', [SettingController::class, 'updateMailSettings'])->name('ajax.setting.updateMailSettings');
    Route::post('updateSystemSettings', [SettingController::class, 'updateSystemSettings'])->name('ajax.setting.updateSystemSettings');
});

Route::prefix('definition')->group(function () {
    Route::get('datatable', [DefinitionController::class, 'datatable'])->name('ajax.definition.datatable');
    Route::get('subDefinitions', [DefinitionController::class, 'subDefinitions'])->name('ajax.definition.subDefinitions');
    Route::post('save', [DefinitionController::class, 'save'])->name('ajax.definition.save');
    Route::delete('drop', [DefinitionController::class, 'drop'])->name('ajax.definition.drop');

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

    Route::get('brands', [DefinitionController::class, 'brands'])->name('ajax.definition.brands');
    Route::get('sectors', [DefinitionController::class, 'sectors'])->name('ajax.definition.sectors');
});
