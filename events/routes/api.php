<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventControllerApi;

Route::prefix('/events')->group(function () {
    Route::get('/', [EventControllerApi::class, 'index']);    
    Route::post('/', [EventControllerApi::class, 'store']);  
    Route::get('/{id}', [EventControllerApi::class, 'show']);     
    Route::match(['put', 'patch'], '/{id}', [EventControllerApi::class, 'update']);
    Route::delete('/{id}', [EventControllerApi::class, 'destroy']); 
});