<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Niepoprawny adres e-mail lub hasło.',
        ]);
    }
}
