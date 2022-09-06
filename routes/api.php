<?php


use App\Http\Controllers\product\ProductBrandController;
use App\Http\Controllers\product\ProductCategoryController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\product\ProductStockController;
use App\Http\Controllers\product\ProductUnitController;
use App\Http\Controllers\product\StockAdjustmentController;
use App\Http\Controllers\setting\CurrencyController;
use App\Http\Controllers\setting\TaxController;
use App\Http\Controllers\setting\WarehouseController;


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









