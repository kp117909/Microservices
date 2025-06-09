<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tworzy 10 losowych użytkowników
        User::factory(10)->create();

        // Dodaje jednego konkretnego użytkownika
        User::factory()->create([
            'name' => 'Test User Admin',
            'first_name' => 'Test Admin',
            'last_name' => 'User Admin',
            'phone' => '123456789',
            'music_genre' => 'Rock',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => Hash::make('test'), // np. hasło: "password"
        ]);

         User::factory()->create([
            'name' => 'Test User',
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '123456788',
            'music_genre' => 'Rock',
            'email' => 'testuser@example.com',
            'is_admin' => false,
            'password' => Hash::make('test'), // np. hasło: "password"
        ]);

        }
}
