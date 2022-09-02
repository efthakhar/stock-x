<?php

use App\Http\Controllers\file\FileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return 'hello';
});

Route::get('/dashboard/{any?}', function () {
    return view('dashboard');
})->where('any','.*');


// File Upload 
Route::post('/file-control',[FileController::class,'upload']);
Route::delete('/file-control',[FileController::class,'delete']);
