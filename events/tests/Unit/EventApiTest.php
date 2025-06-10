<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventApiTest extends TestCase
{
    // Czyści baze przed testami
    use RefreshDatabase;

    // Test listy wydarzeń
    public function test_get_events_list()
    {
        Event::factory()->count(3)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    // Test tworzenia wydarzenia
    public function test_create_event()
    {
        $data = [
            'name' => 'Music Festival',
            'description' => 'Event Describe',
            'location' => 'Warszawa',
            'start_time' => '2024-10-01 20:00:00',
            'end_time' => '2024-10-01 23:00:00',
            'music_genre' => 'Rock',
            'type' => 'Festival'
        ];

        $response = $this->postJson('/api/events', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Music Festival']);

        $this->assertDatabaseHas('events', ['name' => 'Music Festival']);
    }

    // Test wyświetlenia pojedynczego wydarzenia
    public function test_show_event()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/events/' . $event->id);

        $response->assertStatus(200)
                ->assertJsonPath('event.name', $event->name);
    }

    // Test wyświetlenia nieistniejącego wydarzenia
    public function test_show_event_not_found()
    {
        $response = $this->getJson('/api/events/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Event not found']);
    }

    // Test aktualizacji wydarzenia
    public function test_update_event()
    {
        $event = Event::factory()->create();

        $updateData = [
            'name' => 'Changed Name'
        ];

        $response = $this->putJson('/api/events/' . $event->id, $updateData);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Changed Name']);

        $this->assertDatabaseHas('events', ['id' => $event->id, 'name' => 'Changed Name']);
    }

    // Test aktualizacji nieistniejącego wydarzenia
    public function test_update_event_not_found()
    {
        $response = $this->putJson('/api/events/999', ['name' => 'New name']);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Event not found']);
    }

    // Test usuwania wydarzenia
    public function test_delete_event()
    {
        $event = Event::factory()->create();

        $response = $this->deleteJson('/api/events/' . $event->id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Event deleted']);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    // Test usuwania nieistniejącego wydarzenia
    public function test_delete_event_not_found()
    {
        $response = $this->deleteJson('/api/events/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Event not found']);
    }
}