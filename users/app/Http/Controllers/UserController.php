<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

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

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:25',
            'first_name' => 'sometimes|string|max:25',
            'last_name' => 'sometimes|string|max:25',
            'email' => 'sometimes|string|email|max:50|unique:users,email,' . $user->id,
            // 'password' => 'sometimes|string|min:3|confirmed',
            'phone' => ['sometimes', 'string', 'regex:/^\d{3}\d{3}\d{3}$/', 'unique:users,phone,' . $user->id],
            'music_genre' => 'sometimes|string|max:255',
        ]);


        $filteredData = array_filter($validated, function ($value, $key) use ($user) {
            return !empty($value) && $user->$key !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (isset($filteredData['password'])) {
            $filteredData['password'] = Hash::make($filteredData['password']);
        }
        
       if (empty($filteredData)) {
        return $request->expectsJson()
            ? response()->json(['message' => 'No changes detected'], 200)
            : redirect()->back()->with('info', 'No changes detected');
    }

    $user->update($filteredData);

    return $request->expectsJson()
        ? response()->json($user, 200)
        : redirect()->back()->with('success', 'User updated successfully');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
