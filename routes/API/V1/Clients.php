<?php

use App\Http\Controllers\API\V1\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Clients Routes version 1, prefix : /api/v1/
|--------------------------------------------------------------------------
|
*/

Route::middleware('auth:sanctum')->controller(ClientController::class)->prefix('clients')->group(function () {
    Route::put('/store', 'store');
});
