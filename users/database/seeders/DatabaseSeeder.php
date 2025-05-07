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
            'name' => 'Test User',
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '123456789',
            'music_genre' => 'Rock',
            'email' => 'test@example.com',
            'password' => Hash::make('test'), // np. hasło: "password"
        ]);
        }
}
