<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureTime = fake()->dateTimeBetween('+1 day', '+1 week');
        $arrivalTime = fake()->dateTimeBetween($departureTime, (clone $departureTime)->modify('+1 day'));
        return [
            'number' =>fake()->numberBetween(100, 10000),
            'departure_city' =>fake()->city(),
            'arrival_city' =>fake()->city(),
            'departure_time' =>$departureTime,
            'arrival_time' =>$arrivalTime
        ];
    }
}
