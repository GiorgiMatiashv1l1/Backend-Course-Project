<?php

use Illuminate\Routing\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\BookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class);
    Route::post('/events/{event}/book', [BookingController::class, 'book']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
