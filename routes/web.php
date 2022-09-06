<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\auth\UserAuthController;
use App\Http\Controllers\file\FileController;






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

// Authentication 
Route::get('/register',[UserAuthController::class ,'registerPage']); 
Route::post('/register',[UserAuthController::class ,'registerUser']); 

Route::get('/login',[UserAuthController::class ,'loginPage'])->name('login'); 
Route::post('/login',[UserAuthController::class ,'loginUser']); 

Route::get('/logout',[UserAuthController::class ,'logout'])->name('logout'); 

// dashboard

Route::get('/dashboard/{any?}', function () {
    
    if (Auth::check()) {
        return view('dashboard');
    }else{
       return redirect('login');
    }
    
})->where('any','.*')->name('dashboard');


// File Upload 
Route::post('/file-control',[FileController::class,'upload']);
Route::delete('/file-control',[FileController::class,'delete']);
Route::get('/file-control',[FileController::class,'getFiles']);

// backend api routes
include_once('backendapi.php');




