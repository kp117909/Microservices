<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::prefix('/bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);
    Route::get('/byEvent', [BookingController::class, 'indexByEvent']);   
    Route::get('/clean', [BookingController::class, 'indexClean']);          
    Route::post('/', [BookingController::class, 'store']);      
    Route::get('/{id}', [BookingController::class, 'show']);  
    Route::delete('/{id}', [BookingController::class, 'destroy']); 
    Route::delete('byEvent/{eventId}', [BookingController::class, 'destroyByEvent']); 
});
