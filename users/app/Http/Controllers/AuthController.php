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
     
        $validatedData = $request->validate([
            'name' => 'required|string|max:25|unique:users',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone' => ['required', 'string', 'regex:/^\d{3}\d{3}\d{3}$/', 'unique:users,phone'],
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'music_genre' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'music_genre' => $validatedData['music_genre'],
            'country' => $validatedData['country'],
            'city' => $validatedData['city'],
            'zip_code' => $validatedData['zip_code'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);
        

        return view('auth.login');
    }


    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:25|unique:users',
            'first_name' => 'sometimes|string|max:25',
            'last_name' => 'sometimes|string|max:25',
            'email' => 'sometimes|string|email|max:50|unique:users,email,' . $user->id,
            'country' => 'sometimes|string|max:100',
            'city' => 'sometimes|string|max:100',
            'zip_code' => 'sometimes|string|max:20',
            'phone' => ['sometimes', 'string', 'regex:/^\d{3}\d{3}\d{3}$/', 'unique:users,phone,' . $user->id],
            'music_genre' => 'sometimes|string|max:255',
        ]);


        // Filtrowanie zmian
        $filteredData = array_filter($validated, function ($value, $key) use ($user) {
            return !is_null($value) && $value !== '' && $user->$key !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (isset($filteredData['password'])) {
            $filteredData['password'] = Hash::make($filteredData['password']);
        }

        $user->update($filteredData);

        return redirect()->back();
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


    public function redirectUsersList(Request $request)
    {
          $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($genre = $request->input('genre')) {
            $query->where('music_genre', $genre);
        }

        if ($location = $request->input('location')) {
            $query->where('location', 'like', "%$location%");
        }

        $users = $query->paginate(10);

        return view('pages.users_list', compact('users'));
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
