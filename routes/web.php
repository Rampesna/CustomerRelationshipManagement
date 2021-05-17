<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PriceListController;

Route::get('password', function () {
    return bcrypt(123456);
});

Route::get('test', function (\Illuminate\Http\Request $request) {
    return \App\Models\Customer::with([
        'reference'
    ])->find(1);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard.index');
        });
        Route::get('index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('Authority:1');
    });

    Route::prefix('opportunity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('opportunity.index');
        });
        Route::get('index', [OpportunityController::class, 'index'])->name('opportunity.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [OpportunityController::class, 'show'])->name('opportunity.show')->middleware('Authority:1');
    });

    Route::prefix('activity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('activity.index');
        });
        Route::get('index', [ActivityController::class, 'index'])->name('activity.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [ActivityController::class, 'show'])->name('activity.show')->middleware('Authority:1');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('customer.index');
        });
        Route::get('index', [CustomerController::class, 'index'])->name('customer.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [CustomerController::class, 'show'])->name('customer.show')->middleware('Authority:1');
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', function () {
            return redirect()->route('manager.index');
        });
        Route::get('index', [ManagerController::class, 'index'])->name('manager.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [ManagerController::class, 'show'])->name('manager.show')->middleware('Authority:1');
    });

    Route::prefix('sample')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [SampleController::class, 'index'])->name('sample.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [SampleController::class, 'show'])->name('sample.show')->middleware('Authority:1');
    });

    Route::prefix('offer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [OfferController::class, 'index'])->name('offer.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [OfferController::class, 'show'])->name('offer.show')->middleware('Authority:1');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', function () {
            return redirect()->route('stock.index');
        });
        Route::get('index', [StockController::class, 'index'])->name('stock.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [StockController::class, 'show'])->name('stock.show')->middleware('Authority:1');
    });

    Route::prefix('priceList')->group(function () {
        Route::get('/', function () {
            return redirect()->route('priceList.index');
        });
        Route::get('index', [PriceListController::class, 'index'])->name('priceList.index')->middleware('Authority:1');
        Route::get('show/{id?}/{tab?}', [PriceListController::class, 'show'])->name('priceList.show')->middleware('Authority:1');
    });
});
