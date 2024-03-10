<?php

namespace Database\Factories;
use App\Models\User;
use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'title' => fake()->name(),
//            'is_done' => fake()->boolean(50),
            'title' => $this->faker->sentence(),
            'is_done' => false,
            'creator_id'=> User::factory(),
        ];
    }
}
