<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\Event;

class AuthController extends Controller
{

    public function authUserFromSession(Request $request)
    {
        $session_id = $request->query('session_id'); 
        $events = Event::paginate(2); 
        $auth = false;

        if ($session_id) {
            $user_id = Redis::get('session:' . $session_id);

            if ($user_id) {
                $response = Http::get("http://users/api/users/{$user_id}");

                if ($response->ok()) {
                    $userData = $response->json();
                    $user = new ExternalUser($userData); 
                    Auth::login($user, true);
                    Redis::setex('session:' . Session::getId(), 3600, $user_id);
                    $auth = true;
                }
            }
        }

        return view('events_list', compact('auth', 'events'));
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


}