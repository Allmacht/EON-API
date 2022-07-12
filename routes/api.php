<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes version 1
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth routes
Route::put('login', LoginController::class);
Route::middleware('auth:sanctum')->put('logout', LogoutController::class);
Route::middleware('auth:sanctum')->controller(UserController::class)->group(function () {
    Route::get('/user', 'user');
});


//warehouses routes
Route::middleware('auth:sactum')->controller(WarehouseController::class)->prefix('warehouses')->group(function(){
    Route::put('/store', 'store');
});