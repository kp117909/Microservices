<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class EventControllerApi extends Controller
{

    public function index()
    {
        try {
            $events = Event::all()->keyBy('id');
            $bookings = $this->fetchBookings();

            $attendeesPerEvent = [];

            foreach ($bookings as $booking) {
                $eventId = data_get($booking, 'event_data.event.id');

                foreach (data_get($booking, 'event_data.attendees', []) as $user) {
                    $attendeesPerEvent[$eventId][$user['id']] = $user;
                }
            }

            $result = $events->map(function ($event, $eventId) use ($attendeesPerEvent) {
                return [
                    'event' => $event,
                    'attendees' => array_values($attendeesPerEvent[$eventId] ?? []),
                ];
            })->values();

            return response()->json($result, 200);

        } catch (\Throwable $e) {
            Log::error('Error fetching events with attendees', ['exception' => $e]);

            return response()->json([
                'message' => 'Error fetching events with attendees',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function fetchBookings(): array
    {
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
            Log::error('HTPP Error', ['exception' => $e]);
        }

        return [];
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after_or_equal:start_time',
                'music_genre' => 'nullable|string|max:255',
                'type' => 'nullable|string|max:255',
            ]);

            $event = Event::create($validated);

            return response()->json($event, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create event', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);

            $bookings = $this->fetchBookingsForEvent($event->id);
            $attendeeIds = collect($bookings)
                ->pluck('user_id')
                ->unique()
                ->filter()
                ->values();

            $attendees = $attendeeIds->isNotEmpty()
                ? $this->fetchUsersByIds($attendeeIds)
                : [];

            return response()->json([
                'event' => $event,
                'attendees' => $attendees,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);

        } catch (\Throwable $e) {
            Log::error("Error while get event {$id}", ['exception' => $e]);

            return response()->json([
                'message' => 'Error fetching event',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function fetchBookingsForEvent(int $eventId): array
    {
        try {
            $response = Http::timeout(5)->get("http://bookings/api/bookings/byEvent", [
                'event_id' => $eventId
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning("Failed response from bookings for event ID {$eventId}", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Throwable $e) {
            Log::error("HTTP error while fetching bookings for event ID {$eventId}", [
                'exception' => $e
            ]);
        }

        return [];
    }

    private function fetchUsersByIds(Collection $userIds): array
    {
        try {
            $response = Http::timeout(5)->get("http://users/api/users", [
                'ids' => $userIds->toArray()
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::warning("Error response with users API", [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
        } catch (\Throwable $e) {
            Log::error("HTTP error while fetching users", [
                'exception' => $e
            ]);
        }

        return [];
    }


    public function update(Request $request, $id)
    {
        try {
            $event = Event::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after_or_equal:start_time',
                'music_genre' => 'nullable|string|max:255',
                'type' => 'nullable|string|max:255',
            ]);

            $event->update($validated);

            return response()->json($event);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update event', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return response()->json(['message' => 'Event deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete event', 'error' => $e->getMessage()], 500);
        }
    }
}