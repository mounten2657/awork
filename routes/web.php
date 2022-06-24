<?php

use Illuminate\Support\Facades\Route;

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

// index default
Route::get('/', [\App\Http\Controllers\SmploteController::class, 'index']);

// awork
Route::get('/awork', [\App\Http\Controllers\SmploteController::class, 'awork']);

// v1
Route::prefix('v1')->group(function () {
    Route::get('index', [\App\Http\Controllers\SmploteController::class, 'index']);
});

// welcome
Route::get('/welcome', function () {
    return view('welcome');
});
