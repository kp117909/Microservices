<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone' => ['required', 'string', 'regex:/^\d{3}\d{3}\d{3}$/', 'unique:users,phone'],
            'music_genre' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'music_genre' => $request->music_genre,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            $session_id = Session::getId();

            Redis::setex('session:' . $session_id, 3600, $user->id);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Niepoprawny adres e-mail lub hasło.',
        ]);
    }

    public function redirectEvents()
    {
        $user = Auth::user();
        
        $session_id = Session::getId();
        
        if ($user) {
            Redis::setex('session:' . $session_id, 3600, $user->id);
            return redirect(env('EVENTS_SERVICE_URL') . '/events?session_id=' . $session_id);
        } else {
            return redirect(env('EVENTS_SERVICE_URL') . '/events');
        }
    }


    public function redirectUsersList()
    {
        $users = User::paginate(5);

        return view('pages/users_list', compact('users'));
    }
    public function authSession(Request $request)
    {
        $session_id = $request->query('session_id'); 

        if (!$session_id) {
            return redirect(env('APP_SERVICE_URL') . '/');
        }
        
        $user_id = Redis::get('session:' . $session_id);
      
        if (!$user_id) {
            return redirect(env('APP_SERVICE_URL') . '/');
        }

        $user = User::find($user_id);

        if (!$user) {
            return redirect(env('APP_SERVICE_URL') . '/');
        }

        Auth::loginUsingId($user_id);
        return redirect()->route('page.dashboard');
    }
}
