<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
Route::post('/api/events', [EventController::class, 'store']);
Route::get('/api/events', [EventController::class, 'index']);