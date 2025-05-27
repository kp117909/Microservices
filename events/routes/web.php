d<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('page.welcome');

Route::get('/events', [AuthController::class, 'authUserFromSession'])->name('page.events');

Route::get('logout', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('auth.logout');


Route::get('/login', function () {
    return redirect(env('USERS_SERVICE_URL') . '/login');
})->name('page.login');


Route::get('logout', function () {
    return redirect(env('USERS_SERVICE_URL') . '/ext/logout');
})->name('ext.logout');


Route::get('/dashboard', [AuthController::class, 'redirectToUsers'])->name('page.dashboard');

Route::get('/profile', function () {
    return redirect(env('USERS_SERVICE_URL') . '/profile');
})->name('page.profile');

Route::get('/users_list', function () {
    return redirect(env('USERS_SERVICE_URL') . '/users_list');
})->name('page.users_list');

// Route::get('/dashboard', function () {
//     return redirect(env('USERS_SERVICE_URL') . '/dashboard');
// })->name('page.dashboard');


Route::prefix('/api/events')->group(function () {
    Route::get('/', [EventController::class, 'index']);    
    Route::post('/', [EventController::class, 'store']);  
    Route::get('/{id}', [EventController::class, 'show']);     
    Route::put('/{id}', [EventController::class, 'update']);   
    Route::patch('/{id}', [EventController::class, 'update']);
    Route::delete('/{id}', [EventController::class, 'destroy']); 
});
