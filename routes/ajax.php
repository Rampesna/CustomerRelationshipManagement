<?php

use Illuminate\Support\Facades\Route;

Route::post('setSelectedCompany', [\App\Http\Controllers\Ajax\DashboardController::class, 'setSelectedCompany'])->name('ajax.setSelectedCompany');

Route::prefix('dashboard')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\DashboardController::class, 'index'])->name('ajax.dashboard.index');
    Route::get('report', [\App\Http\Controllers\Ajax\DashboardController::class, 'report'])->name('ajax.dashboard.report');
    Route::get('calendar', [\App\Http\Controllers\Ajax\DashboardController::class, 'calendar'])->name('ajax.dashboard.calendar');
});

Route::prefix('opportunity')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\OpportunityController::class, 'index'])->name('ajax.opportunity.index');
    Route::get('check', [\App\Http\Controllers\Ajax\OpportunityController::class, 'check'])->name('ajax.opportunity.check');
    Route::get('datatable', [\App\Http\Controllers\Ajax\OpportunityController::class, 'datatable'])->name('ajax.opportunity.datatable');
    Route::get('reportDatatable', [\App\Http\Controllers\Ajax\OpportunityController::class, 'reportDatatable'])->name('ajax.opportunity.reportDatatable');
    Route::get('show', [\App\Http\Controllers\Ajax\OpportunityController::class, 'show'])->name('ajax.opportunity.show');
    Route::get('showDetail', [\App\Http\Controllers\Ajax\OpportunityController::class, 'showDetail'])->name('ajax.opportunity.showDetail');
    Route::post('save', [\App\Http\Controllers\Ajax\OpportunityController::class, 'save'])->name('ajax.opportunity.save');
    Route::post('createCustomerFromOpportunity', [\App\Http\Controllers\Ajax\OpportunityController::class, 'createCustomerFromOpportunity'])->name('ajax.opportunity.createCustomerFromOpportunity');
    Route::post('import', [\App\Http\Controllers\Ajax\OpportunityController::class, 'import'])->name('ajax.opportunity.import');
    Route::delete('drop', [\App\Http\Controllers\Ajax\OpportunityController::class, 'drop'])->name('ajax.opportunity.drop');

    Route::get('offersDatatable', [\App\Http\Controllers\Ajax\OpportunityController::class, 'offersDatatable'])->name('ajax.opportunity.offersDatatable');
    Route::get('activitiesDatatable', [\App\Http\Controllers\Ajax\OpportunityController::class, 'activitiesDatatable'])->name('ajax.opportunity.activitiesDatatable');
    Route::get('samplesDatatable', [\App\Http\Controllers\Ajax\OpportunityController::class, 'samplesDatatable'])->name('ajax.opportunity.samplesDatatable');
});

Route::prefix('activity')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\ActivityController::class, 'index'])->name('ajax.activity.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\ActivityController::class, 'datatable'])->name('ajax.activity.datatable');
    Route::get('reportDatatable', [\App\Http\Controllers\Ajax\ActivityController::class, 'reportDatatable'])->name('ajax.activity.reportDatatable');
    Route::get('getRelations', [\App\Http\Controllers\Ajax\ActivityController::class, 'getRelations'])->name('ajax.activity.getRelations');
    Route::get('show', [\App\Http\Controllers\Ajax\ActivityController::class, 'show'])->name('ajax.activity.show');
    Route::post('save', [\App\Http\Controllers\Ajax\ActivityController::class, 'save'])->name('ajax.activity.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\ActivityController::class, 'drop'])->name('ajax.activity.drop');
});

Route::prefix('customer')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\CustomerController::class, 'index'])->name('ajax.customer.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'datatable'])->name('ajax.customer.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\CustomerController::class, 'show'])->name('ajax.customer.show');
    Route::post('save', [\App\Http\Controllers\Ajax\CustomerController::class, 'save'])->name('ajax.customer.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\CustomerController::class, 'drop'])->name('ajax.customer.drop');

    Route::get('managersDatatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'managersDatatable'])->name('ajax.customer.managersDatatable');
    Route::get('offersDatatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'offersDatatable'])->name('ajax.customer.offersDatatable');
    Route::get('activitiesDatatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'activitiesDatatable'])->name('ajax.customer.activitiesDatatable');
    Route::get('samplesDatatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'samplesDatatable'])->name('ajax.customer.samplesDatatable');
    Route::get('commentsDatatable', [\App\Http\Controllers\Ajax\CustomerController::class, 'commentsDatatable'])->name('ajax.customer.commentsDatatable');
});

Route::prefix('manager')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\ManagerController::class, 'index'])->name('ajax.manager.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\ManagerController::class, 'datatable'])->name('ajax.manager.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\ManagerController::class, 'show'])->name('ajax.manager.show');
    Route::post('save', [\App\Http\Controllers\Ajax\ManagerController::class, 'save'])->name('ajax.manager.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\ManagerController::class, 'drop'])->name('ajax.manager.drop');
});

Route::prefix('sample')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\SampleController::class, 'index'])->name('ajax.sample.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\SampleController::class, 'datatable'])->name('ajax.sample.datatable');
    Route::get('reportDatatable', [\App\Http\Controllers\Ajax\SampleController::class, 'reportDatatable'])->name('ajax.sample.reportDatatable');
    Route::get('show', [\App\Http\Controllers\Ajax\SampleController::class, 'show'])->name('ajax.sample.show');
    Route::post('save', [\App\Http\Controllers\Ajax\SampleController::class, 'save'])->name('ajax.sample.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\SampleController::class, 'drop'])->name('ajax.sample.drop');

    Route::prefix('sampleItem')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\SampleItemController::class, 'index'])->name('ajax.sampleItem.index');
        Route::get('datatable', [\App\Http\Controllers\Ajax\SampleItemController::class, 'datatable'])->name('ajax.sampleItem.datatable');
        Route::get('show', [\App\Http\Controllers\Ajax\SampleItemController::class, 'show'])->name('ajax.sampleItem.show');
        Route::post('save', [\App\Http\Controllers\Ajax\SampleItemController::class, 'save'])->name('ajax.sampleItem.save');
        Route::delete('drop', [\App\Http\Controllers\Ajax\SampleItemController::class, 'drop'])->name('ajax.sampleItem.drop');
    });
});

Route::prefix('offer')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\OfferController::class, 'index'])->name('ajax.offer.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\OfferController::class, 'datatable'])->name('ajax.offer.datatable');
    Route::get('reportDatatable', [\App\Http\Controllers\Ajax\OfferController::class, 'reportDatatable'])->name('ajax.offer.reportDatatable');
    Route::get('show', [\App\Http\Controllers\Ajax\OfferController::class, 'show'])->name('ajax.offer.show');
    Route::post('save', [\App\Http\Controllers\Ajax\OfferController::class, 'save'])->name('ajax.offer.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\OfferController::class, 'drop'])->name('ajax.offer.drop');
    Route::get('downloadPDF', [\App\Http\Controllers\Ajax\OfferController::class, 'downloadPDF'])->name('ajax.offer.downloadPDF');
    Route::post('sendEmail', [\App\Http\Controllers\Ajax\OfferController::class, 'sendEmail'])->name('ajax.offer.sendEmail');

    Route::get('getCurrency', [\App\Http\Controllers\Ajax\OfferController::class, 'getCurrency'])->name('ajax.offer.getCurrency');

    Route::prefix('offerItem')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\OfferItemController::class, 'index'])->name('ajax.offerItem.index');
        Route::get('datatable', [\App\Http\Controllers\Ajax\OfferItemController::class, 'datatable'])->name('ajax.offerItem.datatable');
        Route::get('show', [\App\Http\Controllers\Ajax\OfferItemController::class, 'show'])->name('ajax.offerItem.show');
        Route::post('save', [\App\Http\Controllers\Ajax\OfferItemController::class, 'save'])->name('ajax.offerItem.save');
        Route::delete('drop', [\App\Http\Controllers\Ajax\OfferItemController::class, 'drop'])->name('ajax.offerItem.drop');
    });
});

Route::prefix('stock')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\StockController::class, 'index'])->name('ajax.stock.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\StockController::class, 'datatable'])->name('ajax.stock.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\StockController::class, 'show'])->name('ajax.stock.show');
    Route::post('save', [\App\Http\Controllers\Ajax\StockController::class, 'save'])->name('ajax.stock.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\StockController::class, 'drop'])->name('ajax.stock.drop');
});

Route::prefix('priceList')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\PriceListController::class, 'index'])->name('ajax.priceList.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\PriceListController::class, 'datatable'])->name('ajax.priceList.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\PriceListController::class, 'show'])->name('ajax.priceList.show');
    Route::post('save', [\App\Http\Controllers\Ajax\PriceListController::class, 'save'])->name('ajax.priceList.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\PriceListController::class, 'drop'])->name('ajax.priceList.drop');
    Route::post('copy', [\App\Http\Controllers\Ajax\PriceListController::class, 'copy'])->name('ajax.priceList.copy');
    Route::get('downloadPDF', [\App\Http\Controllers\Ajax\PriceListController::class, 'downloadPDF'])->name('ajax.priceList.downloadPDF');
    Route::post('sendEmail', [\App\Http\Controllers\Ajax\PriceListController::class, 'sendEmail'])->name('ajax.priceList.sendEmail');

    Route::prefix('priceListItem')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\PriceListItemController::class, 'index'])->name('ajax.priceListItem.index');
        Route::get('datatable', [\App\Http\Controllers\Ajax\PriceListItemController::class, 'datatable'])->name('ajax.priceListItem.datatable');
        Route::get('show', [\App\Http\Controllers\Ajax\PriceListItemController::class, 'show'])->name('ajax.priceListItem.show');
        Route::post('save', [\App\Http\Controllers\Ajax\PriceListItemController::class, 'save'])->name('ajax.priceListItem.save');
        Route::delete('drop', [\App\Http\Controllers\Ajax\PriceListItemController::class, 'drop'])->name('ajax.priceListItem.drop');
    });
});

Route::prefix('file')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\FileController::class, 'index'])->name('ajax.file.index');
    Route::get('show', [\App\Http\Controllers\Ajax\FileController::class, 'show'])->name('ajax.file.show');
    Route::post('save', [\App\Http\Controllers\Ajax\FileController::class, 'save'])->name('ajax.file.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\FileController::class, 'drop'])->name('ajax.file.drop');
});

Route::prefix('social')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\SocialController::class, 'index'])->name('ajax.social.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\SocialController::class, 'datatable'])->name('ajax.social.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\SocialController::class, 'show'])->name('ajax.social.show');
    Route::post('save', [\App\Http\Controllers\Ajax\SocialController::class, 'save'])->name('ajax.social.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\SocialController::class, 'drop'])->name('ajax.social.drop');
});

Route::prefix('comment')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\CommentController::class, 'index'])->name('ajax.comment.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\CommentController::class, 'datatable'])->name('ajax.comment.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\CommentController::class, 'show'])->name('ajax.comment.show');
    Route::post('save', [\App\Http\Controllers\Ajax\CommentController::class, 'save'])->name('ajax.comment.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\CommentController::class, 'drop'])->name('ajax.comment.drop');
});

Route::prefix('note')->group(function () {
    Route::get('show', [\App\Http\Controllers\Ajax\NoteController::class, 'show'])->name('ajax.note.show');
    Route::post('save', [\App\Http\Controllers\Ajax\NoteController::class, 'save'])->name('ajax.note.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\NoteController::class, 'drop'])->name('ajax.note.drop');
});

Route::prefix('meeting')->group(function () {
    Route::get('show', [\App\Http\Controllers\Ajax\MeetingController::class, 'show'])->name('ajax.meeting.show');
    Route::post('save', [\App\Http\Controllers\Ajax\MeetingController::class, 'save'])->name('ajax.meeting.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\MeetingController::class, 'drop'])->name('ajax.meeting.drop');
});

Route::prefix('user')->group(function () {
    Route::get('allWithTarget', [\App\Http\Controllers\Ajax\UserController::class, 'allWithTarget'])->name('ajax.user.all.with.target');
    Route::get('all', [\App\Http\Controllers\Ajax\UserController::class, 'all'])->name('ajax.user.all');
    Route::get('index', [\App\Http\Controllers\Ajax\UserController::class, 'index'])->name('ajax.user.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\UserController::class, 'datatable'])->name('ajax.user.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\UserController::class, 'show'])->name('ajax.user.show');
    Route::post('save', [\App\Http\Controllers\Ajax\UserController::class, 'save'])->name('ajax.user.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\UserController::class, 'drop'])->name('ajax.user.drop');

    Route::get('emailControl', [\App\Http\Controllers\Ajax\UserController::class, 'emailControl'])->name('ajax.user.emailControl');

    Route::prefix('target')->group(function () {
        Route::get('reportDatatable', [\App\Http\Controllers\Ajax\UserController::class, 'targetReportDatatable'])->name('ajax.user.target.reportDatatable');
    });
});

Route::prefix('role')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\RoleController::class, 'index'])->name('ajax.role.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\RoleController::class, 'datatable'])->name('ajax.role.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\RoleController::class, 'show'])->name('ajax.role.show');
    Route::post('save', [\App\Http\Controllers\Ajax\RoleController::class, 'save'])->name('ajax.role.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\RoleController::class, 'drop'])->name('ajax.role.drop');
});

Route::prefix('profile')->group(function () {
    Route::post('updateProfile', [\App\Http\Controllers\Ajax\ProfileController::class, 'updateProfile'])->name('ajax.profile.updateProfile');
    Route::post('updatePassword', [\App\Http\Controllers\Ajax\ProfileController::class, 'updatePassword'])->name('ajax.profile.updatePassword');
});

Route::prefix('target')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\TargetController::class, 'index'])->name('ajax.target.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\TargetController::class, 'datatable'])->name('ajax.target.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\TargetController::class, 'show'])->name('ajax.target.show');
    Route::post('save', [\App\Http\Controllers\Ajax\TargetController::class, 'save'])->name('ajax.target.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\TargetController::class, 'drop'])->name('ajax.target.drop');
});

Route::prefix('ticket')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\TicketController::class, 'index'])->name('ajax.ticket.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\TicketController::class, 'datatable'])->name('ajax.ticket.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\TicketController::class, 'show'])->name('ajax.ticket.show');
    Route::post('save', [\App\Http\Controllers\Ajax\TicketController::class, 'save'])->name('ajax.ticket.save');
    Route::post('setStatus', [\App\Http\Controllers\Ajax\TicketController::class, 'setStatus'])->name('ajax.ticket.setStatus');
    Route::delete('drop', [\App\Http\Controllers\Ajax\TicketController::class, 'drop'])->name('ajax.ticket.drop');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::prefix('permission')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\PermissionController::class, 'index'])->name('ajax.permission.index');
});

Route::prefix('company')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\CompanyController::class, 'index'])->name('ajax.company.index');
});

Route::prefix('country')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\CountryController::class, 'index'])->name('ajax.country.index');

    Route::prefix('erp')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\CountryErpController::class, 'index'])->name('ajax.country.erp.index');
    });
});

Route::prefix('province')->group(function () {
    Route::get('all', [\App\Http\Controllers\Ajax\ProvinceController::class, 'all'])->name('ajax.province.all');
    Route::get('index', [\App\Http\Controllers\Ajax\ProvinceController::class, 'index'])->name('ajax.province.index');

    Route::prefix('erp')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\ProvinceErpController::class, 'index'])->name('ajax.province.erp.index');
    });
});

Route::prefix('district')->group(function () {
    Route::get('all', [\App\Http\Controllers\Ajax\DistrictController::class, 'all'])->name('ajax.district.all');
    Route::get('index', [\App\Http\Controllers\Ajax\DistrictController::class, 'index'])->name('ajax.district.index');

    Route::prefix('erp')->group(function () {
        Route::get('index', [\App\Http\Controllers\Ajax\DistrictErpController::class, 'index'])->name('ajax.district.erp.index');
    });
});

Route::prefix('video')->group(function () {
    Route::get('index', [\App\Http\Controllers\Ajax\VideoController::class, 'index'])->name('ajax.video.index');
    Route::get('datatable', [\App\Http\Controllers\Ajax\VideoController::class, 'datatable'])->name('ajax.video.datatable');
    Route::get('show', [\App\Http\Controllers\Ajax\VideoController::class, 'show'])->name('ajax.video.show');
    Route::post('save', [\App\Http\Controllers\Ajax\VideoController::class, 'save'])->name('ajax.video.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\VideoController::class, 'drop'])->name('ajax.video.drop');
});

Route::prefix('setting')->group(function () {
    Route::get('show', [\App\Http\Controllers\Ajax\SettingController::class, 'show'])->name('ajax.setting.show');
    Route::post('updateMailSettings', [\App\Http\Controllers\Ajax\SettingController::class, 'updateMailSettings'])->name('ajax.setting.updateMailSettings');
    Route::post('updateSystemSettings', [\App\Http\Controllers\Ajax\SettingController::class, 'updateSystemSettings'])->name('ajax.setting.updateSystemSettings');
});

Route::prefix('erpMatch')->group(function () {
    Route::get('datatable', [\App\Http\Controllers\Ajax\ErpMatchController::class, 'datatable'])->name('ajax.erpMatch.datatable');
    Route::post('save', [\App\Http\Controllers\Ajax\ErpMatchController::class, 'save'])->name('ajax.erpMatch.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\ErpMatchController::class, 'drop'])->name('ajax.erpMatch.drop');
});

Route::prefix('definition')->group(function () {
    Route::get('datatable', [\App\Http\Controllers\Ajax\DefinitionController::class, 'datatable'])->name('ajax.definition.datatable');
    Route::get('subDefinitions', [\App\Http\Controllers\Ajax\DefinitionController::class, 'subDefinitions'])->name('ajax.definition.subDefinitions');
    Route::post('save', [\App\Http\Controllers\Ajax\DefinitionController::class, 'save'])->name('ajax.definition.save');
    Route::delete('drop', [\App\Http\Controllers\Ajax\DefinitionController::class, 'drop'])->name('ajax.definition.drop');

    Route::get('opportunityPriorities', [\App\Http\Controllers\Ajax\DefinitionController::class, 'opportunityPriorities'])->name('ajax.definition.opportunityPriorities');
    Route::get('opportunityAccessTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'opportunityAccessTypes'])->name('ajax.definition.opportunityAccessTypes');
    Route::get('opportunityEstimatedResultTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'opportunityEstimatedResultTypes'])->name('ajax.definition.opportunityEstimatedResultTypes');
    Route::get('opportunityCapacityTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'opportunityCapacityTypes'])->name('ajax.definition.opportunityCapacityTypes');
    Route::get('opportunityStatuses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'opportunityStatuses'])->name('ajax.definition.opportunityStatuses');

    Route::get('activityMeetingReasons', [\App\Http\Controllers\Ajax\DefinitionController::class, 'activityMeetingReasons'])->name('ajax.definition.activityMeetingReasons');
    Route::get('activityPriorities', [\App\Http\Controllers\Ajax\DefinitionController::class, 'activityPriorities'])->name('ajax.definition.activityPriorities');

    Route::get('customerClasses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'customerClasses'])->name('ajax.definition.customerClasses');
    Route::get('customerTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'customerTypes'])->name('ajax.definition.customerTypes');
    Route::get('customerReferences', [\App\Http\Controllers\Ajax\DefinitionController::class, 'customerReferences'])->name('ajax.definition.customerReferences');

    Route::get('managerDepartments', [\App\Http\Controllers\Ajax\DefinitionController::class, 'managerDepartments'])->name('ajax.definition.managerDepartments');
    Route::get('managerTitles', [\App\Http\Controllers\Ajax\DefinitionController::class, 'managerTitles'])->name('ajax.definition.managerTitles');

    Route::get('cargoCompanies', [\App\Http\Controllers\Ajax\DefinitionController::class, 'cargoCompanies'])->name('ajax.definition.cargoCompanies');
    Route::get('sampleStatuses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'sampleStatuses'])->name('ajax.definition.sampleStatuses');

    Route::get('offerPayTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'offerPayTypes'])->name('ajax.definition.offerPayTypes');
    Route::get('offerDeliveryTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'offerDeliveryTypes'])->name('ajax.definition.offerDeliveryTypes');
    Route::get('offerStatuses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'offerStatuses'])->name('ajax.definition.offerStatuses');

    Route::get('unitTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'unitTypes'])->name('ajax.definition.unitTypes');
    Route::get('stockTypes', [\App\Http\Controllers\Ajax\DefinitionController::class, 'stockTypes'])->name('ajax.definition.stockTypes');
    Route::get('stockStatuses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'stockStatuses'])->name('ajax.definition.stockStatuses');

    Route::get('priceListStatuses', [\App\Http\Controllers\Ajax\DefinitionController::class, 'priceListStatuses'])->name('ajax.definition.priceListStatuses');

    Route::get('brands', [\App\Http\Controllers\Ajax\DefinitionController::class, 'brands'])->name('ajax.definition.brands');
    Route::get('sectors', [\App\Http\Controllers\Ajax\DefinitionController::class, 'sectors'])->name('ajax.definition.sectors');
});
