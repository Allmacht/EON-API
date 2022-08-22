<?php

use App\Http\Controllers\API\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Users Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

//users routes
Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/me', 'user');

    Route::patch('/update-warehouse', 'updateWarehouse');
});
