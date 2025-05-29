<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'event_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}