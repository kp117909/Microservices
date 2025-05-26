<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'name' => 'Rock Festival',
            'description' => 'A full-day rock music festival featuring well-known bands.',
            'location' => 'Warszawa, Stadion Narodowy',
            'start_time' => now()->addDays(10)->setTime(15, 0),
            'end_time' => now()->addDays(10)->setTime(23, 0),
            'music_genre' => 'Rock',
            'type' => 'Festival',
        ]);

        Event::create([
            'name' => 'Jazz Night',
            'description' => 'An intimate candlelit jazz evening..',
            'location' => 'Kraków, Klub Jazzowy',
            'start_time' => now()->addDays(5)->setTime(19, 30),
            'end_time' => now()->addDays(5)->setTime(22, 0),
            'music_genre' => 'Jazz',
            'type' => 'Concert',
        ]);

        Event::create([
            'name' => 'Electronic Beats Party',
            'description' => 'A night party featuring the best electronic DJs.',
            'location' => 'Wrocław, Hala Stulecia',
            'start_time' => now()->addWeeks(2)->setTime(21, 0),
            'end_time' => now()->addWeeks(2)->addDay()->setTime(4, 0),
            'music_genre' => 'Electric',
            'type' => 'Event',
        ]);

        Event::factory()->count(20)->create();
    }
}
