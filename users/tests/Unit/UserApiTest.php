<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    // Czyści baze przed testami
    // use RefreshDatabase;

    // Test pobierania wszystkich użytkowników
    public function test_get_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // Test pobierania pojedynczego użytkownika
    public function test_get_single_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $user->id]);
    }

    // Test wyświetlenia nieistniejącego użytkownika
    public function test_show_user_not_found()
    {
        $response = $this->getJson('/api/users/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'User not found']);
    }

    // Test tworzenia nowego użytkownika
    public function test_create_user()
    {
        $userData = [
            'name' => 'TestName',
            'first_name' => 'First',
            'last_name' => 'Last',
            'email' => 'test@example.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'phone' => '123456789',
            'country' => 'Poland',
            'city' => 'Warszawa',
            'zip_code' => '39-164',
            'music_genre' => 'Rock',
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'test@example.com']);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    // Test aktualizacji użytkownika (PUT/PATCH)
    public function test_update_user()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'UpdatedName',
            'music_genre' => 'Jazz',
        ];

        $response = $this->patchJson('/api/users/' . $user->id, $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'UpdatedName', 'music_genre' => 'Jazz']);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'UpdatedName']);
    }

     // Test aktualizacji nieistniejącego użytkownika
    public function test_update_user_not_found()
    {
        $response = $this->putJson('/api/users/999', ['name' => 'Not founded name of course']);
 
        $response->assertStatus(404)
                 ->assertJson(['message' => 'User not found']);
    }


    // Test usuwania użytkownika
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'User deleted successfully']);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

     // Test usuwania nieistniejącego wydarzenia
    public function test_delete_user_not_found()
    {
        $response = $this->deleteJson('/api/users/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'User not found']);
    }
}