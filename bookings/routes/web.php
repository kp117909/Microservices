<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return redirect(env('APP_SERVICE_URL') . '/');
})->name('page.welcome');


Route::prefix('/api/bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);         // Lista rezerwacji
    Route::post('/', [BookingController::class, 'store']);        // Nowa rezerwacja
    Route::get('/{id}', [BookingController::class, 'show']);      // Szczegóły rezerwacji
    Route::put('/{id}', [BookingController::class, 'update']);    // Aktualizacja
    Route::patch('/{id}', [BookingController::class, 'update']);  // Aktualizacja (częściowa)
    Route::delete('/{id}', [BookingController::class, 'destroy']); // Usunięcie
});
