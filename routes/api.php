<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Personas\PersonasController;

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

Route::group(['namespace' => 'Api'], function () {
    Route::group(["prefix" => "personas", "namespace" => "Personas"], function () {
        Route::post('store', [PersonasController::class, 'store']); //store to person in the database
        Route::get('index', [PersonasController::class, 'index']); //store to person in the database
        Route::post('update/{id?}', [PersonasController::class, 'update']); //store to person in the database
        Route::delete('destroy/{id?}', [PersonasController::class, 'destroy']); //store to person in the database
    });
});
