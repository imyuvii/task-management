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
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(4),
            'priority' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'status' => $this->faker->randomElement(['New', 'Incomplete', 'Completed']),
            'start_date' => $this->faker->dateTimeBetween('-1 years', '-10 days'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 months'),
        ];
    }
}
