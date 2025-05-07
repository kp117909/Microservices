<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\App;


Route::get('/', function () {
    return view('welcome');
})->name('page.welcome');

Route::get('/login', function () {
    return redirect(env('USERS_SERVICE_URL') . '/login');
})->name('page.login');


Route::get('/register', function () {
    return redirect(env('USERS_SERVICE_URL') . '/register');
})->name('page.register');


Route::get('/events', function () {
    return redirect(env('EVENTS_SERVICE_URL') . '/events');
})->name('page.events');

Route::get('/users_list', function () {
    return redirect(env('USERS_SERVICE_URL') . '/users_list');
})->name('page.users_list');