<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    public static function fetchEventData($eventId)
    {
        try {
            $response = Http::timeout(5)->get("http://events/api/events/{$eventId}");
            if ($response->successful()) {
                return $response->json();
            }
            Log::warning("Error fetching event data {$eventId}", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Throwable $e) {
            Log::error("HTTP error fetching event ID {$eventId}", ['exception' => $e]);
        }
        return null;
    }

    public static function fetchUserData($userId)
    {
        try {
            $response = Http::timeout(5)->get("http://users/api/users/{$userId}");
            if ($response->successful()) {
                return $response->json();
            }
            Log::warning("Error fetching user data {$userId}", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Throwable $e) {
            Log::error("HTTP error fetching user ID {$userId}", ['exception' => $e]);
        }
        return null;
    }


}


