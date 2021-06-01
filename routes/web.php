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
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

Route::get('password', function () {
    return bcrypt(123456);
});

Route::get('test', function (\Illuminate\Http\Request $request) {
    return view('emails.test', [

    ]);
});

Route::get('mailTest', function () {
    return view('emails.offer');
});

Auth::routes();

Route::middleware(['auth', 'MobileDetect'])->group(function () {
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
        Route::get('index', [OpportunityController::class, 'index'])->name('opportunity.index')->middleware('Authority:13');
        Route::get('show/{id?}/{tab?}', [OpportunityController::class, 'show'])->name('opportunity.show')->middleware('Authority:13');
    });

    Route::prefix('activity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('activity.index');
        });
        Route::get('index', [ActivityController::class, 'index'])->name('activity.index')->middleware('Authority:19');
        Route::get('show/{id?}/{tab?}', [ActivityController::class, 'show'])->name('activity.show')->middleware('Authority:19');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('customer.index');
        });
        Route::get('index', [CustomerController::class, 'index'])->name('customer.index')->middleware('Authority:24');
        Route::get('show/{id?}/{tab?}', [CustomerController::class, 'show'])->name('customer.show')->middleware('Authority:24');
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', function () {
            return redirect()->route('manager.index');
        });
        Route::get('index', [ManagerController::class, 'index'])->name('manager.index')->middleware('Authority:35');
        Route::get('show/{id?}/{tab?}', [ManagerController::class, 'show'])->name('manager.show')->middleware('Authority:35');
    });

    Route::prefix('sample')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [SampleController::class, 'index'])->name('sample.index')->middleware('Authority:40');
        Route::get('show/{id?}/{tab?}', [SampleController::class, 'show'])->name('sample.show')->middleware('Authority:40');
    });

    Route::prefix('offer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [OfferController::class, 'index'])->name('offer.index')->middleware('Authority:45');
        Route::get('show/{id?}/{tab?}', [OfferController::class, 'show'])->name('offer.show')->middleware('Authority:45');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', function () {
            return redirect()->route('stock.index');
        });
        Route::get('index', [StockController::class, 'index'])->name('stock.index')->middleware('Authority:50');
        Route::get('show/{id?}/{tab?}', [StockController::class, 'show'])->name('stock.show')->middleware('Authority:50');
    });

    Route::prefix('priceList')->group(function () {
        Route::get('/', function () {
            return redirect()->route('priceList.index');
        });
        Route::get('index', [PriceListController::class, 'index'])->name('priceList.index')->middleware('Authority:55');
        Route::get('show/{id?}/{tab?}', [PriceListController::class, 'show'])->name('priceList.show')->middleware('Authority:55');
    });

    Route::prefix('definition')->group(function () {
        Route::get('/', function () {
            return redirect()->route('definition.index');
        });
        Route::get('index', [DefinitionController::class, 'index'])->name('definition.index')->middleware('Authority:60');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.index');
        });
        Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('Authority:3');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', function () {
            return redirect()->route('role.index');
        });
        Route::get('index', [RoleController::class, 'index'])->name('role.index')->middleware('Authority:8');
    });

    Route::prefix('country')->group(function () {
        Route::get('/', function () {
            return redirect()->route('country.index');
        });
        Route::get('index', [CountryController::class, 'index'])->name('country.index')->middleware('Authority:1');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', function () {
            return redirect()->route('profile.index');
        });
        Route::get('index', [ProfileController::class, 'index'])->name('profile.index')->middleware('Authority:1');
    });

    Route::prefix('report')->group(function () {
        Route::get('/', function () {
            return redirect()->route('report.index');
        });
        Route::get('index', [ReportController::class, 'index'])->name('report.index')->middleware('Authority:1');
    });
});
