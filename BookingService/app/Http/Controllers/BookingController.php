<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ]);
        return response()->json($booking);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Booking::where('event_id', $event_id)->with('user')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
