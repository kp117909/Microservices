<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\BookingsApiController;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{

    public function index()
    {
        try {
            $query = Booking::query();

            if (request()->has('event_id')) {
                $query->where('event_id', request('event_id'));
            }

            $bookings = $query->get();
            $result = [];

            $grouped = $bookings->groupBy('event_id');

            $eventsData = [];

            foreach ($grouped as $eventId => $eventBookings) {
                $eventsData[$eventId] = Http::get("http://events/api/events/{$eventId}")->json();
            }

            foreach ($bookings as $booking) {
                $eventId = $booking->event_id;

                $result[] = [
                    'booking_id' => $booking->id,
                    'event_data' => $eventsData[$eventId] ?? null,
                ];
            }

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching bookings',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'event_id' => 'required|integer',
            ]);

            if (!BookingsApiController::externalApiCheckUserExists($validated['user_id'])) {
                return response()->json(['error' => 'User does not exist'], 400);
            }

            if(!BookingsApiController::externalApiCheckEventExists($validated['event_id'])) {
                return response()->json(['error' => 'Event does not exist'], 400);
            }

            $existingBooking = Booking::where('user_id', $validated['user_id'])
                ->where('event_id', $validated['event_id'])
                ->first();

            if ($existingBooking) {
                return response()->json(['error' => 'This user is already registered for this event'], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
            $booking = Booking::create($validated);
            return response()->json($booking, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create booking', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            $event = Http::get("http://events/api/events/{$booking->event_id}")->json();

            return response()->json([
                'booking_id' => $booking->id,
                'event_data' => $event,
            ], 200);

        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Booking not found'], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(['message' => 'Booking deleted'], 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'Booking not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete booking', 'error' => $e->getMessage()], 500);
        }
    }

    public function indexByEvent(Request $request)
    {
        $eventId = $request->query('event_id');

        $bookings = Booking::where('event_id', $eventId)->get();

        return response()->json($bookings);
    }

     public function indexClean()
        {
            try {
                $result = Booking::all();
                return response()->json($result, 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error fetching bookings',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

}