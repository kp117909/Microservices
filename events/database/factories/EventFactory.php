<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city() . ', ' . $this->faker->streetAddress(),
            'start_time' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'end_time' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'music_genre' => $this->faker->randomElement(['Rock', 'Jazz', 'Electric', 'Hip-Hop', 'Indie', 'Clasicc']),
            'type' => $this->faker->randomElement(['Concert', 'Festival', 'Party', 'Event']),
        ];
    }
}
