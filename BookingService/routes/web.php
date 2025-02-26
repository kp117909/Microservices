<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::post('/api/bookings', [BookingController::class, 'store']);
Route::get('/api/bookings/{event_id}', [BookingController::class, 'show']);