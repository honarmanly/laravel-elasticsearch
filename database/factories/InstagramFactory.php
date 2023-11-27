<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InstagramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'posted_at' => fake()->dateTime(),
            'type' => fake()->numberBetween(0, 5),
            'link' => fake()->url(),
            'post_content' => fake()->sentence(),
            'poster' => fake()->name(),
        ];
    }
}
