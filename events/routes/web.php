<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
Route::get('/', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('page.welcome');

Route::get('/events', [AuthController::class, 'index'])
    ->middleware('auth.from.session')
    ->name('page.events');

Route::get('logout', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('auth.logout');


Route::get('/login', function () {
    return redirect(env('USERS_SERVICE_URL') . '/login');
})->name('page.login');


Route::get('logout', function () {
    return redirect(env('USERS_SERVICE_URL') . '/ext/logout');
})->name('ext.logout');

Route::get('/dashboard', [AuthController::class, 'redirectToUsers'])
->middleware('auth.from.session')
->name('page.dashboard');

Route::get('/profile', function () {
    return redirect(env('USERS_SERVICE_URL') . '/profile');
})->name('page.profile');

Route::get('/users_list', [AuthController::class, 'redirectToUsersList'])->name('page.users_list');

Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::post('/events_join', [EventController::class, 'join'])->name('events.join');

Route::get('/event/details/{event_id}', [EventController::class, 'details'])
->middleware('check.session')
->name('event.details');

Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])
->middleware('check.session')
->name('event.destroy');

Route::match(['put', 'patch'], '/events/{id}', [EventController::class, 'update'])
->middleware('check.session')
->name('event.update');
// Route::get('/dashboard', function () {
//     return redirect(env('USERS_SERVICE_URL') . '/dashboard');
// })->name('page.dashboard');
