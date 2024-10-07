
<?php

use App\Http\Controllers\Api\PowersyncController;
use Illuminate\Support\Facades\Route;

Route::get('/get_powersync_token', [PowersyncController::class, 'getPowerSyncToken'])->middleware('auth:api');
Route::get('/get_keys', [PowersyncController::class, 'getKeys']); // this is publicly available
