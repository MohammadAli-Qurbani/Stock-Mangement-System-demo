<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpirationController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\GoodReportController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReturnedController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
// Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logOut', [AuthController::class, 'logOut'])->name('auth.logOut');
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/getSuppliers', 'getSuppliers')->name('suppliers.getSuppliers');
        Route::post('/suppliers', 'store')->name('supplier.store');
        Route::get('/suppliers/{supplier}', 'edit')->name('supplier.edit');
        Route::put('/suppliers/{supplier}', 'update')->name('suppliers.update');
        Route::delete('/suppliers/{supplier}', 'destroy')->name('suppliers.delete');
    });
    Route::controller(GoodController::class)->group(function () {
        Route::get('/getGoods', 'getGoods')->name('goods.getGoods');
        Route::post('/goods', 'store')->name('goods.store');
        Route::get('/goods/{good}', 'show')->name('goods.show');
        Route::get('/goods/{good}/edit', 'edit')->name('goods.edit');
        Route::put('/goods/{good}','update')->name('goods.update');
        Route::get('/good/getSuppliers', 'getSuppliers')->name('getSuppliers');
    });

    Route::controller(StockController::class)->group(function () {
        Route::get('/stocks', 'index')->name('stocks.index');
        Route::get('/getStocks', 'getStocks')->name('stocks.getStocks');
        Route::get('/stocks/{stock}', 'show')->name('stocks.show');
    });

    Route::controller(SellController::class)->group(function () {
        Route::get('/getSells', 'getSells')->name('sells.getSells');
        Route::post('/sells', 'store')->name('sells.store');
    });
    Route::resource('/categories', CategoryController::class);
    Route::get('/getCategories', [CategoryController::class, 'getCategories'])->name('categories.getCategories');
    Route::controller(GoodReportController::class)->group(function () {
        Route::get('/report/goods/daily', 'daily')->name('goods.daily.reports');
        Route::get('/report/goods/monthly', 'monthly')->name('goods.monthly.reports');
        Route::get('/report/goods/yearly', 'yearly')->name('goods.yearly.reports');
        // charts reports section
        Route::get('/report/goods/charts', 'chart')->name('good.reports.chart');
        Route::get('/report/goods/chart/yearly', 'yearlyChart')->name('good.reports.chart.yearly');
    });

    Route::controller(SellReportController::class)->group(function () {
        // Route::get('/report/selles/table', 'tableReport')->name('sell.tableReport');
        Route::get('/report/selles/daily', 'daily')->name('sell.daily');
        Route::get('/reports/selles/charts', 'monthly')->name('report.selles.chart');
        // Route::get('/reports/selles/charts/yearlyChart', 'yearlyChart')->name('report.selles.yearlyChart');
        Route::get('/reports/selles/charts/yearly', 'yearly')->name('report.selles.chart');
    });
    Route::controller(ExpirationController::class)->group(function () {
        // Route::get('/expiring', 'index')->name('goods.expiring');
        // Route::get('/getExpirationView', 'getExpirationView')->name('getExpirationView');
        Route::get('/expirations', 'getExpiration')->name('all.expired.goods');
        Route::get('/expireAfterOnMonth', 'expireAfterOnMonth');
        Route::get('/expiringToDay', 'expiringToDay');
        Route::get('/expiring/next/year', 'expireNextYear')->name('good.expiring.next.year');
    });

    Route::controller(IncomeController::class)->group(function () {
        // Route::get('/monthIncomeView', 'monthly')->name('monthly.income');
        // Route::get('/yearIncomeView', 'yearly')->name('yearly.income');
        Route::get('/dailyIncome','dailyIncome')->name('dailyIncome');
        Route::get('/monthlyIncome', 'monthlyIncome')->name('monthlyIncome');
        Route::get('/yearlyIncome', 'yearlyIncome')->name('yearlyIncome');
    });
    Route::controller(ReturnedController::class)->group(function () {
        // Route::get('/returneds', 'index')->name('returned.index');
        Route::get('/getReturneds', 'getReturned')->name('returned.goods');
        Route::get('/returneds/good', 'getGoods')->name('goods.to.return');
        Route::post('/returneds', 'store')->name('returned.store');
        Route::get('/returned/all/goods', 'retundedGood')->name('goods.returned');
        Route::get('/returneds/getGoods', 'getRetuneds')->name('getReturnedGoods');

        // Route::get('/returned/report', 'report')->name('returned.report');
        Route::get('/returned/monthly/report', 'monthly')->name('returned.month.report');
        Route::get('/returned/yearly/report', 'yearly')->name('returned.yearly.report');
    });

// });
