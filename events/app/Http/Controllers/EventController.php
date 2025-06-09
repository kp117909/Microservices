<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;


class EventController extends Controller
{
    public function index()
    {
        try {
            $events = Event::all();
            return response()->json($events);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching events', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'location' => 'required|string|max:255',
                'start_time' => 'required|date',
                'end_time' => 'nullable|date|after_or_equal:start_time',
                'type' => 'required|in:Concert,Festival,Meetup,Workshop',
                'music_genre' => 'nullable|string|max:100',
                'description' => 'nullable|string|max:1000',
            ]);

            Event::create($validated);

            return redirect()->back()->with('success', 'Event created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }


    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching event', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'music_genre' => 'required|in:Rock,Pop,Jazz,Hip-Hop',
            'type' => 'required|in:Concert,Festival,Meetup,Workshop',
        ]);

        $event = Event::findOrFail($id);
        $event->update($validated);

        return redirect()->back()->with('success', 'Event updated successfully.');
    }


   public function destroy(Request $request, $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();

            $response = Http::delete(env('BOOKINGS_SERVICE_URL_CONTAINER') . "/api/bookings/byEvent/{$id}");

            return redirect()->back()->with('success', 'Event deleted successfully.');

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Event not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete event', 'error' => $e->getMessage()], 500);
        }
    }


    public function join(Request $request)
    {
        $response = Http::post(env('BOOKINGS_SERVICE_URL_CONTAINER') . '/api/bookings', [
            'user_id' => $request->input('user_id'),
            'event_id' => $request->input('event_id'),
        ]);

        if ($response->successful()) {
            return back()->with('success', "Joined to event - ". $request->event_name);
        }

        return back()->with('error', "Unable to join to event");
    }

   public function details(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $user = $request->attributes->get('external_user');
        $sessionId = $request->attributes->get('session_id');
        $auth = $user !== null;

        return view('event', compact('event', 'user', 'sessionId', 'auth'));
    }

    public function getUserEvents($userId)
    {
        $events = app(EventService::class)->getEventsForUser($userId);
        return response()->json($events);
    }
}