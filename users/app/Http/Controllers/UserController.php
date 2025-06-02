<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            
            if ($request->has('ids')) {
                return User::whereIn('id', $request->ids)->get();
            }
            
            $users = User::all();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching users', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        try {
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
            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user', 'error' => $e->getMessage()], 500);
        }

        try {
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
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Filtrowanie zmian
        $filteredData = array_filter($validated, function ($value, $key) use ($user) {
            return !is_null($value) && $value !== '' && $user->$key !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (isset($filteredData['password'])) {
            $filteredData['password'] = Hash::make($filteredData['password']);
        }

        if (empty($filteredData)) {
            return response()->json(['message' => 'No changes detected'], 200);
        }

        try {
            $user->update($filteredData);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update user', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (ModelNotFoundException) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
        }
    }
}