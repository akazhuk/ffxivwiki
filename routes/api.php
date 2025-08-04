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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('xiv')->group(function () {
    // asset
    Route::prefix('assets')->controller(\App\Http\Controllers\Assets::class)->group(function () {
        Route::get("/", 'asset');
        Route::get("/map", 'map');
    });

    // search
    Route::prefix('search')->controller(\App\Http\Controllers\Search::class)->group(function () {
        Route::get("/", 'search');
    });

    // sheets
    Route::prefix('sheets')->controller(\App\Http\Controllers\Sheets::class)->group(function () {
        Route::get("/list", 'list');
        Route::get("/list-rows", 'rows');
        Route::get("/read-sheet-row", 'readSheetRow');
    });
});
