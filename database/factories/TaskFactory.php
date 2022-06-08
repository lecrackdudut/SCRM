<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => $this->faker->words(5, true),
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement(['open', 'in_progress', 'closed']),
            'score' => $this->faker->randomDigit(),
        ];
    }
}
