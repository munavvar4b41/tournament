<?php

namespace Database\Factories;

use App\Enums\SeasonStatus;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Season>
 */
class SeasonFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('+1 week', '+1 month');
        $endsAt = fake()->dateTimeBetween($startsAt, '+6 months');

        return [
            'name' => fake()->words(3, true),
            'game_type' => fake()->randomElement(['cricket', 'football', 'basketball', 'tennis']),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'registration_opens_at' => now(),
            'registration_closes_at' => $startsAt,
            'status' => SeasonStatus::Draft,
        ];
    }
}
