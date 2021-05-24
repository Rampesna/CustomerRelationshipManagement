<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\DashboardController;
use App\Http\Controllers\Mobile\OpportunityController;
use App\Http\Controllers\Mobile\ActivityController;
use App\Http\Controllers\Mobile\CustomerController;
use App\Http\Controllers\Mobile\ManagerController;
use App\Http\Controllers\Mobile\SampleController;
use App\Http\Controllers\Mobile\OfferController;
use App\Http\Controllers\Mobile\StockController;
use App\Http\Controllers\Mobile\PriceListController;
use App\Http\Controllers\Mobile\DefinitionController;
use App\Http\Controllers\Mobile\UserController;
use App\Http\Controllers\Mobile\RoleController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('mobile.dashboard.index');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return redirect()->route('mobile.dashboard.index');
        });
        Route::get('index', [DashboardController::class, 'index'])->name('mobile.dashboard.index')->middleware('Authority:1');
    });

    Route::prefix('opportunity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('opportunity.index');
        });
        Route::get('index', [OpportunityController::class, 'index'])->name('mobile.opportunity.index')->middleware('Authority:13');
        Route::get('show/{id?}/{tab?}', [OpportunityController::class, 'show'])->name('mobile.opportunity.show')->middleware('Authority:13');
    });

    Route::prefix('activity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('activity.index');
        });
        Route::get('index', [ActivityController::class, 'index'])->name('mobile.activity.index')->middleware('Authority:19');
        Route::get('show/{id?}/{tab?}', [ActivityController::class, 'show'])->name('mobile.activity.show')->middleware('Authority:19');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('customer.index');
        });
        Route::get('index', [CustomerController::class, 'index'])->name('mobile.customer.index')->middleware('Authority:24');
        Route::get('show/{id?}/{tab?}', [CustomerController::class, 'show'])->name('mobile.customer.show')->middleware('Authority:24');
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', function () {
            return redirect()->route('manager.index');
        });
        Route::get('index', [ManagerController::class, 'index'])->name('mobile.manager.index')->middleware('Authority:35');
        Route::get('show/{id?}/{tab?}', [ManagerController::class, 'show'])->name('mobile.manager.show')->middleware('Authority:35');
    });

    Route::prefix('sample')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [SampleController::class, 'index'])->name('mobile.sample.index')->middleware('Authority:40');
        Route::get('show/{id?}/{tab?}', [SampleController::class, 'show'])->name('mobile.sample.show')->middleware('Authority:40');
    });

    Route::prefix('offer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [OfferController::class, 'index'])->name('mobile.offer.index')->middleware('Authority:45');
        Route::get('show/{id?}/{tab?}', [OfferController::class, 'show'])->name('mobile.offer.show')->middleware('Authority:45');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', function () {
            return redirect()->route('stock.index');
        });
        Route::get('index', [StockController::class, 'index'])->name('mobile.stock.index')->middleware('Authority:50');
        Route::get('show/{id?}/{tab?}', [StockController::class, 'show'])->name('mobile.stock.show')->middleware('Authority:50');
    });

    Route::prefix('priceList')->group(function () {
        Route::get('/', function () {
            return redirect()->route('priceList.index');
        });
        Route::get('index', [PriceListController::class, 'index'])->name('mobile.priceList.index')->middleware('Authority:55');
        Route::get('show/{id?}/{tab?}', [PriceListController::class, 'show'])->name('mobile.priceList.show')->middleware('Authority:55');
    });

    Route::prefix('definition')->group(function () {
        Route::get('/', function () {
            return redirect()->route('definition.index');
        });
        Route::get('index', [DefinitionController::class, 'index'])->name('mobile.definition.index')->middleware('Authority:60');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.index');
        });
        Route::get('index', [UserController::class, 'index'])->name('mobile.user.index')->middleware('Authority:3');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', function () {
            return redirect()->route('role.index');
        });
        Route::get('index', [RoleController::class, 'index'])->name('mobile.role.index')->middleware('Authority:8');
    });
});
