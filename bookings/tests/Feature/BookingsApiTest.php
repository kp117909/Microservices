<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_bookings()
    {
        Booking::factory()->count(3)->create();

        $response = $this->getJson('/api/bookings');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_get_single_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->getJson('/api/bookings/' . $booking->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $booking->id]);
    }

    public function test_show_booking_not_found()
    {
        $response = $this->getJson('/api/bookings/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Booking not found']);
    }

    public function test_create_booking_with_existing_user_and_event()
    {
        $bookingData = [
            'user_id' => 8, // użytkownik musi być w bazie
            'event_id' => 8, // event musi być w bazie
        ];

        $response = $this->postJson('/api/bookings', $bookingData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['user_id' => 8, 'event_id' => 8]);

        $this->assertDatabaseHas('bookings', ['user_id' => 8, 'event_id' => 8]);

        $response2 = $this->postJson('/api/bookings', $bookingData);
        $response2->assertStatus(400);
        $response2->dump();
        $response2->assertJsonFragment(['error' => 'This user is already registered for this event']);
    } 

     public function test_cannot_create_booking_with_nonexistent_user()
    {
        $bookingData = [
            'user_id' => 999, // nieistniejący użytkownik
            'event_id' => 8,
        ];
        
        $response = $this->postJson('/api/bookings', $bookingData);
        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'User does not exist',
        ]);
    }

    public function test_cannot_create_booking_with_nonexistent_event()
    {

        $bookingData = [
            'user_id' => 8,
            'event_id' => 999, // nieistniejące wydarzenie
        ];

        $response = $this->postJson('/api/bookings', $bookingData);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Event does not exist',
        ]);
    }

    public function test_delete_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->deleteJson('/api/bookings/' . $booking->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Booking deleted']);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function test_delete_booking_not_found()
    {
        $response = $this->deleteJson('/api/bookings/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Booking not found']);
    }
}