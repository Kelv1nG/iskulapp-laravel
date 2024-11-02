
<?php

use App\Http\Controllers\Api\PowersyncController;
use App\Http\Controllers\Api\PowersyncDataController;
use Illuminate\Support\Facades\Route;

Route::get('/get_powersync_token', [PowersyncController::class, 'getPowerSyncToken'])->middleware('auth:api');
Route::get('/get_keys', [PowersyncController::class, 'getKeys']); // this is publicly available
Route::match(['put', 'patch', 'delete'], '/upload_data', [PowersyncDataController::class, 'uploadData'])->middleware('auth:api');
