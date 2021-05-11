<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpportunityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    return auth()->user()->id();
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
    });
});
