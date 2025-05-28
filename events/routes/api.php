<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::prefix('/events')->group(function () {
    Route::get('/', [EventController::class, 'index']);    
    Route::post('/', [EventController::class, 'store']);  
    Route::get('/{id}', [EventController::class, 'show']);     
    Route::match(['put', 'patch'], '/{id}', [EventController::class, 'update']);
    Route::delete('/{id}', [EventController::class, 'destroy']); 
});