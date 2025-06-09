<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\EventControllerApi;
use App\Services\EventService;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthController extends Controller
{

    public function index(Request $request, EventService $eventService)
    {
        $user = $request->attributes->get('external_user');
        $sessionId = $request->attributes->get('session_id');
        $auth = $user !== null;

        $events = $eventService->getEventsWithAttendees();
      
        $filtered = $events->filter(function ($item) use ($request) {
            $event = $item['event'];

            return (!$request->filled('start_time') || $event['start_time'] >= $request->start_time)
                && (!$request->filled('end_time') || $event['end_time'] <= $request->end_time)
                && (!$request->filled('type') || $event['type'] === $request->type)
                && (!$request->filled('genre') || $event['music_genre'] === $request->genre)
                && (!$request->filled('search') || str_contains(strtolower($event['name']), strtolower($request->search)) || str_contains(strtolower($event['description']), strtolower($request->search)));
        });

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 2;
        $pagedEvents = new LengthAwarePaginator(
            $filtered->forPage($currentPage, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('events_list', compact('auth', 'user', 'sessionId', 'pagedEvents'));
    }



    public function redirectToUsers()
    {
        $session_id = Session::getId();
    
        $user_id = Redis::get('session:' . $session_id);
    
        if ($user_id) {
            return redirect(env('USERS_SERVICE_URL') . '/auth/session?session_id=' . $session_id);
        } else {
            return redirect(env('USERS_SERVICE_URL') . '/auth/session');
        }
    }

    public function redirectToUsersList()
    {
        $session_id = Session::getId();
    
        $user_id = Redis::get('session:' . $session_id);
    
        if ($user_id) {
            return redirect(env('USERS_SERVICE_URL') . '/auth/session?session_id=' . $session_id);
        } else {
            return redirect(env('USERS_SERVICE_URL') . '/auth/session');
        }
    }


}