<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EventService
{
    public function getEventsWithAttendees(bool $fullData = true): \Illuminate\Support\Collection
    {
        $events = Event::all()->keyBy('id');
        $bookings = $this->fetchBookings();

        $attendeesPerEvent = [];

        foreach ($bookings as $booking) {
            $eventId = data_get($booking, 'event_data.event.id');

            foreach (data_get($booking, 'event_data.attendees', []) as $user) {
               $attendeesPerEvent[$eventId][$user['id']] = $fullData
                ? $user
                : [
                    'id' => $user['id'],
                    'name' => $user['name'] ?? 'Unknown',
                ];
            }
        }

        return $events->map(function ($event, $eventId) use ($attendeesPerEvent) {
            return [
                'event' => $event,
                'attendees' => array_values($attendeesPerEvent[$eventId] ?? []),
            ];
        })->values();
    }

    private function fetchBookings(): array
    {
        return cache()->remember('bookings_full_data', 0, function () {
            try {
                $response = Http::timeout(5)->get("http://bookings/api/bookings");

                if ($response->successful()) {
                    return $response->json();
                }

                Log::warning('Error response with bookings API', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            } catch (\Throwable $e) {
                Log::error('HTTP Error', ['exception' => $e]);
            }

            return [];
        });
    }


}
