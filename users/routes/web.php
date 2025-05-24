<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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


    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('page.profile');


    Route::get('logout', function () {
        Auth::logout();
        return redirect(env('APP_SERVICE_URL') . '/');
    })->name('auth.logout');

});


Route::get('/ext/logout', function () {
    Auth::logout();
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('ext.logout');

Route::prefix('/api/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);      
    Route::post('/', [UserController::class, 'store']);     
    Route::get('/{id}', [UserController::class, 'show']); 
    Route::put('/{id}', [UserController::class, 'update']); 
    Route::patch('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']); 
});

Route::get('/events', [AuthController::class, 'redirectEvents'])->name('page.events');

Route::get('/users_list', [AuthController::class, 'redirectUsersList'])->name('page.users_list');

Route::get('/auth/session', [AuthController::class, 'authSession'])->name('auth.session');
