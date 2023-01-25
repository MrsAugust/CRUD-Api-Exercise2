<?php

use App\Http\Controllers\driversController;
use App\Http\Controllers\vehiclesController;
use App\Http\Controllers\detailsController;
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

/**
 * All the CREATE-data requests for the database.
 **/

Route::post('driver', [driversController::class, 'store']);
Route::post('vehicle', [vehiclesController::class, 'store']);

/**
 * All the GET-data requests for the database.
 **/

Route::apiResource('drivers', driversController::class);  //returns all the drivers
Route::apiResource('vehicles', vehiclesController::class);  //returns all the vehicles
Route::get('driver/{id}',[driversController::class, 'show']); //returns 1-specified driver/details/vehicle
Route::get('driver/{id}/details', [detailsController::class, 'show']);  //returns the details of 1-driver
Route::get('driver/{id}/vehicle', [vehiclesController::class, 'show']); //returns the vehicle of 1-driver

/**
 * All the PUT-data requests for the database.
 **/

Route::put('drivers/{id}', [driversController::class, 'update']);
Route::put('drivers/{id}/details', [detailsController::class, 'update']);
Route::put('vehicle/{id}', [vehiclesController::class, 'update']);

/**
 * All the DELETE-data requests for the database.
 **/

Route::delete('drivers/{id}', [driversController::class, 'destroy']);
Route::delete('drivers/{id}/details', [detailsController::class, 'destroy']);
Route::delete('vehicle/{id}', [vehiclesController::class, 'destroy']);
