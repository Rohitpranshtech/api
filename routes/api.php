<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
});

Route::get('customer',[Customercontroller::class,'index']);
Route::post('customer1',[Customercontroller::class,'store']);
Route::put('update',[Customercontroller:: class,'update']);
//Route::delete('delete',[Customercontroller:: class,'destroy']);
Route::resource('users',Customercontroller::class);
Route::get('customer/search/{name}',[Customercontroller::class,'search']);
Route::post('register',[userController::class,'store']);
