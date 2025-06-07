<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\ExternalUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Event;

class AuthController extends Controller
{

    public function authUserFromSession(Request $request)
    {
        $token = $request->query('token');

        $auth = false;
        $user = null;

        if ($token) {
            try {
                $payload = JWTAuth::setToken($token)->getPayload();
                $userData = [
                    'id' => $payload->get('id'),
                    'name' => $payload->get('name'),
                    'first_name' => $payload->get('first_name') ?? null,
                    'last_name' => $payload->get('last_name') ?? null,
                    'email' => $payload->get('email'),
                    'phone' => $payload->get('phone') ?? null,
                    'music_genre' => $payload->get('music_genre') ?? null,
                ];

                $user = new ExternalUser($userData);
                Auth::login($user);
                Auth::user() === $user;
                $auth = true;
            } catch (JWTException $e) {
                $auth = false;
                $user = null;
            }
        }
        $query = Event::query();

        if ($request->filled('start_time')) {
            $query->whereDate('start_time', '>=', $request->start_time);
        }

        if ($request->filled('end_time')) {
            $query->whereDate('end_time', '<=', $request->end_time);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('genre')) {
            $query->where('music_genre', $request->genre);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
            });
        }

        $events = $query->latest()->paginate(2)->withQueryString();

        return view('events_list', compact('auth', 'events', 'user'));
    }


    public function redirectToUsers()
    {
        $user = Auth::user();

        if ($user) {

             $customClaims = [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'music_genre' => $user->music_genre,
            ];

            $token = JWTAuth::claims($customClaims)->setTTL(60)->encode();

            return redirect(env('USERS_SERVICE_URL') . '/dashboard?token=' . $token);
        }

        return redirect(env('USERS_SERVICE_URL') . '/');
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