<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'capital' => fake()->numberBetween(100, 100000),
            'welcome_bonus' => fake()->numberBetween(100, 100000),
            'daily_tasks' => fake()->numberBetween(5, 100),
            'profit_per_task' =>fake()->numberBetween(100, 100000),
            'is_automated' => false,
        ];
    }

    // public function levelOne(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
