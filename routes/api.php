<?php

use App\Http\Controllers\AuthControlle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Customercontroller;
use  App\Http\Controllers\userController;

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

Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('logout', [userController::class, 'logout']);
  Route::get('customer', [Customercontroller::class, 'index']);
  Route::post('customer1', [Customercontroller::class, 'store']);
  Route::put('update', [Customercontroller::class, 'update']);
  Route::resource('users', Customercontroller::class);
  Route::get('customer/search/{name}', [Customercontroller::class, 'search']);
  
});




//Route::delete('delete',[Customercontroller:: class,'destroy']);
Route::post('register', [userController::class, 'store']);
// Route::post('login', [userController::class, 'login']);
Route::post('login', [userController::class, 'login']);


