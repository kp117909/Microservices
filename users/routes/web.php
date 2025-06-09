<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserEventController;

Route::get('/', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('page.welcome');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('page.register');

Route::post('/register', [AuthController::class, 'store'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('page.dashboard');
    

    Route::get('/profile', [UserEventController::class, 'getUserEvents'])->name('page.profile');

    Route::patch('/users/{id}', [AuthController::class, 'update'])->name('users_form.update');

    Route::post('/users/eventLeave/{eventId}', [UserEventController::class, 'leave'])->name('users.event.leave');

    Route::get('logout', function () {
        Auth::logout();
        return redirect(env('APP_SERVICE_URL') . '/');
    })->name('auth.logout');

});


Route::get('/ext/logout', function () {
    Auth::logout();
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('ext.logout');


Route::get('/events', [AuthController::class, 'redirectEvents'])->name('page.events');

Route::get('/users_list', [AuthController::class, 'redirectUsersList'])->name('page.users_list');

Route::get('/auth/session', [AuthController::class, 'authSession'])->name('auth.session');
