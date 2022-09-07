<?php

use App\Http\Controllers\auth\PermissionController;
use App\Http\Controllers\auth\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\product\ProductBrandController;
use App\Http\Controllers\product\ProductCategoryController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\product\ProductStockController;
use App\Http\Controllers\product\ProductUnitController;
use App\Http\Controllers\product\StockAdjustmentController;
use App\Http\Controllers\setting\CurrencyController;
use App\Http\Controllers\setting\TaxController;
use App\Http\Controllers\setting\WarehouseController;
use App\Http\Controllers\user\UserController;
use Illuminate\Http\Request;

Route::prefix('api')->middleware( ['is_logged_in'] )->group(function () {


    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    // User
    Route::get('/users',[UserController::class,'index']);
    Route::get('/users/{id}',[UserController::class,'show']);
    Route::post('/users',[UserController::class,'store']);
    Route::put('/users/{id}',[UserController::class,'update']);
    Route::delete('/users/{id}',[UserController::class,'delete']);

    

    //Role
    Route::get('/roles',[RoleController::class,'index']);

    //Permissions
    Route::get('/permissions',[PermissionController::class,'index']);
    Route::get('/permissions/byuser/{id}',[PermissionController::class,'permissionsByUser']);
    Route::get('/permissions/byrole/{id}',[PermissionController::class,'permissionsByrole']);
    Route::put('/permissions/change/{role_id}',
    [PermissionController::class,'changePermissionsByrole']);



    //////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////

    //Warehouse
    Route::get('/warehouses',[WarehouseController::class,'index']);
    Route::get('/warehouses/{id}',[WarehouseController::class,'show']);
    Route::post('/warehouses',[WarehouseController::class,'store']);
    Route::put('/warehouses/{id}',[WarehouseController::class,'update']);
    Route::delete('/warehouses/{id}',[WarehouseController::class,'delete']);

    //Currency
    Route::get('/currencies',[CurrencyController::class,'index']);
    Route::get('/currencies/{id}',[CurrencyController::class,'show']);
    Route::post('/currencies',[CurrencyController::class,'store']);
    Route::put('/currencies/{id}',[CurrencyController::class,'update']);
    Route::delete('/currencies/{id}',[CurrencyController::class,'delete']);

    //Tax
    Route::get('/taxes',[TaxController::class,'index']);
    Route::get('/taxes/{id}',[TaxController::class,'show']);
    Route::post('/taxes',[TaxController::class,'store']);
    Route::put('/taxes/{id}',[TaxController::class,'update']);
    Route::delete('/taxes/{id}',[TaxController::class,'delete']);



    ////////////////////////////////////////////
    ////////////////////////////////////////////


    //Product category
    Route::get('/product-categories',[ProductCategoryController::class,'index']);
    Route::get('/product-categories/childcats/{id}',[ProductCategoryController::class,'getAllChildCats']);
    Route::get('/product-categories/{id}',[ProductCategoryController::class,'show']);
    Route::post('/product-categories',[ProductCategoryController::class,'store']);
    Route::put('/product-categories/{id}',[ProductCategoryController::class,'update']);
    Route::delete('/product-categories/{id}',[ProductCategoryController::class,'delete']);

    //Product Brands
    Route::get('/product-brands',[ProductBrandController::class,'index']);
    Route::get('/product-brands/{id}',[ProductBrandController::class,'show']);
    Route::post('/product-brands',[ProductBrandController::class,'store']);
    Route::put('/product-brands/{id}',[ProductBrandController::class,'update']);
    Route::delete('/product-brands/{id}',[ProductBrandController::class,'delete']);

    //Product Units
    Route::get('/product-units',[ProductUnitController::class,'index']);
    Route::get('/product-units/{id}',[ProductUnitController::class,'show']);
    Route::post('/product-units',[ProductUnitController::class,'store']);
    Route::put('/product-units/{id}',[ProductUnitController::class,'update']);
    Route::delete('/product-units/{id}',[ProductUnitController::class,'delete']);


    //Product 
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/products/search/{name}',[ProductController::class,'getProductByName']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'delete']);


    // Product  Stock
    Route::get('/product-stocks',[ProductStockController::class,'index']);
    Route::get('/product-stocks/{id}/{wid}',[ProductStockController::class,'show']);
    Route::post('/product-stocks',[ProductStockController::class,'store']);
    Route::put('/product-stocks/{id}',[ProductStockController::class,'update']);
    Route::delete('/product-stocks/{id}',[ProductStockController::class,'delete']);


    // Stock Adjustment
    Route::get('/stock-adjustments',[StockAdjustmentController::class,'index']);
    Route::get('/stock-adjustments/{id}',[StockAdjustmentController::class,'show']);
    Route::post('/stock-adjustments',[StockAdjustmentController::class,'store']);
    Route::put('/stock-adjustments/{id}',[StockAdjustmentController::class,'update']);
    Route::delete('/stock-adjustments',[StockAdjustmentController::class,'delete']);

    
});
    


?>