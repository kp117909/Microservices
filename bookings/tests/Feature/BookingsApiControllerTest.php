<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BookingsApiControllerTest extends TestCase
{

    /** @test */
    public function it_fetches_events_list()
    {
        // Mockujemy odpowiedź API
        Http::fake([
            'http://localhost:8002/' => Http::response([
                ['id' => 1, 'name' => 'Event 1'],
                ['id' => 2, 'name' => 'Event 2'],
            ], 200),
        ]);

        $response = $this->get('/api/events');
        
        $response->assertStatus(200);
        // sprawdzamy, czy odpowiedź zawiera dane
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['name' => 'Event 1']);
    }

    /** @test */
    public function it_fetches_single_event()
    {
        $eventId = 5;

        Http::fake([
            "http://localhost:8002/{$eventId}" => Http::response([
                'id' => $eventId,
                'name' => 'Test Event'
            ], 200),
        ]);

        $response = $this->get("/api/events/{$eventId}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $eventId, 'name' => 'Test Event']);
    }

    /** @test */
    public function it_returns_404_if_event_not_found()
    {
        $eventId = 999;

        Http::fake([
            "http://localhost:8002/{$eventId}" => Http::response([], 404),
        ]);

        $response = $this->get("/api/events/{$eventId}");

        $response->assertStatus(404);
    }

    /** @test */
    public function it_creates_a_new_event()
    {
        $newEventData = [
            'name' => 'New Event',
            'date' => '2023-10-20',
        ];

        Http::fake([
            'http://localhost:8002/' => Http::response(['id' => 10] + $newEventData, 201),
        ]);

        $response = $this->post('/api/events', $newEventData);

        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'New Event']);
    }

    /** @test */
    public function it_updates_an_event()
    {
        $eventId = 3;
        $updateData = [
            'name' => 'Updated Event Name',
        ];

        Http::fake([
            "http://localhost:8002/{$eventId}" => Http::response(['id' => $eventId, 'name' => 'Old Name'], 200),
        ]);

        $response = $this->put("/api/events/{$eventId}", $updateData);

        // Zakładam, że API zwraca zaktualizowany obiekt
        Http::fake([
            "http://localhost:8002/{$eventId}" => Http::response(['id' => $eventId, 'name' => 'Updated Event Name'], 200),
        ]);

        $response = $this->patch("/api/events/{$eventId}", $updateData);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Updated Event Name']);
    }

    /** @test */
    public function it_deletes_an_event()
    {
        $eventId = 7;

        Http::fake([
            "http://localhost:8002/{$eventId}" => Http::response(null, 204),
        ]);

        $response = $this->delete("/api/events/{$eventId}");

        $response->assertStatus(204);
    }
}