<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserEventController extends Controller
{

    public function getUserEvents()
    {
  
        $user =  Auth::user();
        $response = Http::get(env('EVENTS_SERVICE_URL_CONTAINER') . "/events/user/{$user->id}");

       if ($response->successful()) {
            $userEvents = collect($response->json())->map(function ($event) {
                return [
                    ...$event,
                    'start_time' => (new \DateTime($event['start_time']))->format('Y-m-d H:i'),
                    'end_time' => (new \DateTime($event['end_time']))->format('Y-m-d H:i'),
                ];
            });

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 2;
            $pagedData = new LengthAwarePaginator(
                $userEvents->forPage($currentPage, $perPage)->values(),
                $userEvents->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('pages.profile', ['user_events' => $pagedData]);
        }

        return view('pages.profile');
    }

    public function leave($eventId)
    {
        $user = Auth::user();

        $response = Http::delete(env('BOOKINGS_SERVICE_URL_CONTAINER') . "/api/bookings/user/{$user->id}/event/{$eventId}");
        $message = $response->json()['message'];
        return redirect()->back()->with('success', $message);
    }


}