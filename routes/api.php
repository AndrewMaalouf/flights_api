<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/passengers', [PassengerController::class], 'index');

Route::get('/flights', [FlightController::class], 'index');

Route::get('flights/{flightId}/passengers', [PassengerController::class], 'getPassengerByFlightId');
