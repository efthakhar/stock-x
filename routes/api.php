<?php

use App\Http\Controllers\product\ProductCategoryController;
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

// Product category
Route::get('/product-categories',[ProductCategoryController::class,'index']);
Route::get('/product-categories/childcats/{id}',[ProductCategoryController::class,'getAllChildCats']);
Route::get('/product-categories/{id}',[ProductCategoryController::class,'show']);
Route::post('/product-categories',[ProductCategoryController::class,'store']);
Route::put('/product-categories/{id}',[ProductCategoryController::class,'update']);
Route::delete('/product-categories/{id}',[ProductCategoryController::class,'delete']);
