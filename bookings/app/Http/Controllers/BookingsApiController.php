<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class BookingsApiController extends Controller
{
    // Funkcja do sprawdzania czy użytkownik istnieje
    public static function externalApiCheckUserExists($userId)
    {
        $baseUrl = config('services.users');
        $url = $baseUrl . '/api/users/' . $userId;
        $response = Http::get($url);

        if ($response->successful()) {
            return true;
        }
        if ($response->status() == 404) {
            return false;
        }
        return false;
    }

    // Funkcja do sprawdzania czy wydarzenie istnieje
    public static function externalApiCheckEventExists($eventId)
    {
        $baseUrl = config('services.events');
        $url = $baseUrl . '/api/events/' . $eventId;
        $response = Http::get($url);

        if ($response->successful()) {
            return true;
        }
        if ($response->status() == 404) {
            return false;
        }
        return false;
}
}
