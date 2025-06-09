<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\BookingsApiController;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{

   public function index()
    {
        try {
            $bookings = Booking::when(request('event_id'), function ($query, $eventId) {
                return $query->where('event_id', $eventId);
            })->get();

            $result = [];

            foreach ($bookings as $booking) {
            
                $eventData = BookingsApiController::fetchEventData($booking->event_id);
          
                $userData = BookingsApiController::fetchUserData($booking->user_id);

                $result[] = [
                    'booking_id' => $booking->id,
                    'event_data' => $eventData,
                    'user_data' => $userData,
                ];
            }

            return response()->json($result, 200);

        } catch (\Throwable $e) {
            Log::error('Booking index error', ['exception' => $e]);

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

        
            try {
                if (!BookingsApiController::externalApiCheckUserExists($validated['user_id'])) {
                    return response()->json(['error' => 'User does not exist'], 400);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to verify user existence', 'details' => $e->getMessage()], 500);
            }

            try {
                if (!BookingsApiController::externalApiCheckEventExists($validated['event_id'])) {
                    return response()->json(['error' => 'Event does not exist'], 400);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to verify event existence', 'details' => $e->getMessage()], 500);
            }

            $existingBooking = Booking::where('user_id',    $validated['user_id'])
                ->where('event_id', $validated['event_id'])
                ->first();

            if ($existingBooking) {
                return response()->json(['error' => 'This user is already registered for this event'], 400);
            }

            $booking = Booking::create($validated);

            return response()->json($booking, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create booking', 'error' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            $event = BookingsApiController::fetchEventData($booking->event_id);
            $user = BookingsApiController::fetchUserData($booking->user_id);

            return response()->json([
                'booking_id' => $booking->id,
                'event_data' => $event,
                'user_data' => $user,
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

    public function destroyByEvent($eventId)
    {
        try {
            $deletedCount = Booking::where('event_id', $eventId)->delete();

            if ($deletedCount === 0) {
                return response()->json(['message' => 'No bookings found for this event'], 404);
            }

            return response()->json(['message' => 'Bookings deleted', 'count' => $deletedCount], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete bookings', 'error' => $e->getMessage()], 500);
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