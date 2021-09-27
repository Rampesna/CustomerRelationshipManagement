<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('test', [\App\Http\Controllers\HomeController::class, 'index']);

Route::any('oauth', [\App\Http\Controllers\OauthController::class, 'login']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard.index', ['tab' => 'index']);
        });
        Route::get('{tab?}', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index')->middleware('Authority:1');
    });

    Route::prefix('opportunity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('opportunity.index');
        });
        Route::get('index', [\App\Http\Controllers\OpportunityController::class, 'index'])->name('opportunity.index')->middleware('Authority:13');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\OpportunityController::class, 'show'])->name('opportunity.show')->middleware('Authority:13');
    });

    Route::prefix('activity')->group(function () {
        Route::get('/', function () {
            return redirect()->route('activity.index');
        });
        Route::get('index', [\App\Http\Controllers\ActivityController::class, 'index'])->name('activity.index')->middleware('Authority:19');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\ActivityController::class, 'show'])->name('activity.show')->middleware('Authority:19');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('customer.index');
        });
        Route::get('index', [\App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index')->middleware('Authority:24');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show')->middleware('Authority:24');
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', function () {
            return redirect()->route('manager.index');
        });
        Route::get('index', [\App\Http\Controllers\ManagerController::class, 'index'])->name('manager.index')->middleware('Authority:35');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\ManagerController::class, 'show'])->name('manager.show')->middleware('Authority:35');
    });

    Route::prefix('sample')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [\App\Http\Controllers\SampleController::class, 'index'])->name('sample.index')->middleware('Authority:40');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\SampleController::class, 'show'])->name('sample.show')->middleware('Authority:40');
    });

    Route::prefix('offer')->group(function () {
        Route::get('/', function () {
            return redirect()->route('sample.index');
        });
        Route::get('index', [\App\Http\Controllers\OfferController::class, 'index'])->name('offer.index')->middleware('Authority:45');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\OfferController::class, 'show'])->name('offer.show')->middleware('Authority:45');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/', function () {
            return redirect()->route('stock.index');
        });
        Route::get('index', [\App\Http\Controllers\StockController::class, 'index'])->name('stock.index')->middleware('Authority:50');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\StockController::class, 'show'])->name('stock.show')->middleware('Authority:50');
    });

    Route::prefix('priceList')->group(function () {
        Route::get('/', function () {
            return redirect()->route('priceList.index');
        });
        Route::get('index', [\App\Http\Controllers\PriceListController::class, 'index'])->name('priceList.index')->middleware('Authority:55');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\PriceListController::class, 'show'])->name('priceList.show')->middleware('Authority:55');
    });

    Route::prefix('definition')->group(function () {
        Route::get('/', function () {
            return redirect()->route('definition.index');
        });
        Route::get('index', [\App\Http\Controllers\DefinitionController::class, 'index'])->name('definition.index')->middleware('Authority:60');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.index');
        });
        Route::get('index', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index')->middleware('Authority:3');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', function () {
            return redirect()->route('role.index');
        });
        Route::get('index', [\App\Http\Controllers\RoleController::class, 'index'])->name('role.index')->middleware('Authority:8');
    });

    Route::prefix('country')->group(function () {
        Route::get('/', function () {
            return redirect()->route('country.index');
        });
        Route::get('index', [\App\Http\Controllers\CountryController::class, 'index'])->name('country.index')->middleware('Authority:1');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', function () {
            return redirect()->route('profile.index');
        });
        Route::get('index', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index')->middleware('Authority:1');
    });

    Route::prefix('target')->group(function () {
        Route::get('/', function () {
            return redirect()->route('target.index');
        });
        Route::get('index', [\App\Http\Controllers\TargetController::class, 'index'])->name('target.index')->middleware('Authority:1');
    });

    Route::prefix('report')->group(function () {
        Route::get('/', function () {
            return redirect()->route('report.index');
        });
        Route::get('index', [\App\Http\Controllers\ReportController::class, 'index'])->name('report.index')->middleware('Authority:1');
        Route::get('show/{report?}', [\App\Http\Controllers\ReportController::class, 'show'])->name('report.show')->middleware('Authority:1');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', function () {
            return redirect()->route('setting.index');
        });
        Route::get('index', [\App\Http\Controllers\SettingController::class, 'index'])->name('setting.index')->middleware('Authority:1');
        Route::get('show/{setting?}', [\App\Http\Controllers\SettingController::class, 'show'])->name('setting.show')->middleware('Authority:1');
    });

    Route::prefix('erpMatch')->group(function () {
        Route::get('/', function () {
            return redirect()->route('erpMatch.index');
        });
        Route::get('index', [\App\Http\Controllers\ErpMatchController::class, 'index'])->name('erpMatch.index')->middleware('Authority:1');
        Route::get('show/{match?}', [\App\Http\Controllers\ErpMatchController::class, 'show'])->name('erpMatch.show')->middleware('Authority:1');
    });

    Route::prefix('ticket')->group(function () {
        Route::get('/', function () {
            return redirect()->route('ticket.index');
        });
        Route::get('index', [\App\Http\Controllers\TicketController::class, 'index'])->name('ticket.index')->middleware('Authority:1');
        Route::get('show/{id?}', [\App\Http\Controllers\TicketController::class, 'show'])->name('ticket.show')->middleware('Authority:1');
    });

    Route::prefix('ticket-message')->group(function () {
        Route::post('save', [\App\Http\Controllers\TicketMessageController::class, 'save'])->name('ticket-message.save');
    });

    Route::prefix('video')->group(function () {
        Route::get('/', function () {
            return redirect()->route('video.index');
        });
        Route::get('index', [\App\Http\Controllers\VideoController::class, 'index'])->name('video.index');
        Route::get('settings', [\App\Http\Controllers\VideoController::class, 'settings'])->name('video.settings');
    });
});
