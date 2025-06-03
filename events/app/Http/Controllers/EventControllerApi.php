<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

class EventControllerApi extends Controller
{

    public function index()
    {
        try {
            $events = Event::all();

            $bookingsResponse = Http::get("http://bookings/api/bookings");
            $bookings = $bookingsResponse->json();

            $attendeesPerEvent = [];

            foreach ($bookings as $booking) {
                $eventId = $booking['event_data']['event']['id'];

                foreach ($booking['event_data']['attendees'] as $user) {
                    $attendeesPerEvent[$eventId][$user['id']] = $user; 
                }
            }

            $result = [];

            foreach ($events as $event) {
                $eventId = $event['id'];
                $attendees = isset($attendeesPerEvent[$eventId])
                    ? array_values($attendeesPerEvent[$eventId])
                    : [];

                $result[] = [
                    'event' => $event,
                    'attendees' => $attendees
                ];
            }

            return response()->json($result, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching events with attendees',
                'error' => $e->getMessage()
            ], 500);
        }
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

            $bookingsResponse = Http::timeout(5)->get("http://bookings/api/bookings/byEvent", [
                'event_id' => $event->id
            ]);

            $bookings = $bookingsResponse->json();

            $attendeeIds = [];

            foreach ($bookings as $booking) {
                if ($booking['event_id'] == $event->id) {
                    $attendeeIds[] = $booking['user_id'];
                }
            }

            $attendees = [];

            if (!empty($attendeeIds)) {
               $attendees = Http::get("http://users/api/users", [
                'ids' => $attendeeIds
                ])->json();
            }

            return response()->json([
                'event' => $event,
                'attendees' => $attendees
            ], 200);

            return response()->json($result, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching event', 'error' => $e->getMessage()], 500);
        }
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