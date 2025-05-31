<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'type' => 'required|in:Concert,Festival,Meetup,Workshop',
            'music_genre' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $event = Event::create($validated);

        return redirect()->back();
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