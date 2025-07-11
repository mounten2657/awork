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

// default index
Route::get('/', [\App\Http\Controllers\Smplote\SmploteController::class, 'awork']);

// awork
Route::get('/{uri}', [\App\Http\Controllers\Smplote\SmploteController::class, 'awork'])
    ->where('uri', 'awork|index|index.html');
// cnzz
Route::get('/cnzz', [\App\Http\Controllers\Smplote\SmploteController::class, 'cnzz']);

// v1 page
Route::prefix('v1')->group(function () {
    Route::get('index.html', [\App\Http\Controllers\Smplote\SmploteController::class, 'index']);
});

// welcome
Route::get('/welcome', function () {
    return view('welcome');
});
