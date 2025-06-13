<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']);  // If you have a store method to create bookings
    Route::post('events/{event}/book', [BookingController::class, 'book']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
});
