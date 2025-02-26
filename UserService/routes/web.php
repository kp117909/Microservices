<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


Route::post('/api/register', [UserController::class, 'register']);
Route::get('/api/users', [UserController::class, 'index']);
