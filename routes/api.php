<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// ua
Route::middleware('trim')->get('/ua', function (Request $request) {
    return $request->header('user-agent');
});

// awork
Route::prefix('awork')->group(function () {
    Route::get('index', [\App\Http\Controllers\Awork\AworkController::class, 'index']);
});

// extra
Route::prefix('extra')->group(function () {
    Route::post('sha', [\App\Http\Controllers\Extra\ExtraController::class, 'sha']);
});



