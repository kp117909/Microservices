<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::prefix('/bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);      
    Route::post('/', [BookingController::class, 'store']);      
    Route::get('/{id}', [BookingController::class, 'show']);  
    Route::match(['put', 'patch'], '/{id}', [BookingController::class, 'update']);
    Route::delete('/{id}', [BookingController::class, 'destroy']); 
});
