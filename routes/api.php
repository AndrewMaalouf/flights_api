<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\UserController;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

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

Route::resource('passengers', PassengerController::class);

Route::resource('flights', FlightController::class);

Route::resource('users', UserController::class);

Route::get('/flights/{flightId}/passengers', [PassengerController::class], 'getPassengerByFlightId');

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('register', [AuthController::class, 'register']);

//     Route::group(['middleware' => 'auth:sanctum'], function() {
//       Route::get('logout', [AuthController::class, 'logout']);
//       Route::get('user', [AuthController::class, 'user']);
//     });
// });

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
