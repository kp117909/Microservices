<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

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

    Route::get('logout', function () {
        Auth::logout();
        return redirect(env('APP_SERVICE_URL') . '/');
    })->name('auth.logout');
});

