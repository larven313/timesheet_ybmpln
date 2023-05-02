<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity' => fake()->catchPhrase(),
            'type_id' => mt_rand(1, 6),
            'date' => fake()->dateTimeThisYear(),
            'time' => fake()->randomDigitNotNull(),
            'user_id' => mt_rand(1, 11)
        ];
    }
}
