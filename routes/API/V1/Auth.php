<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

Route::put('login', LoginController::class);
Route::middleware('auth:sanctum')->put('logout', LogoutController::class);
