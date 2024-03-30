<?php

namespace Database\Factories;

use App\Models\TaskType;
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
            //
        ];
    }

    public function youtube(): static {
        return $this->state(fn (array $attributes) => [
            'task_type_id' => TaskType::where('name', 'like', '%youtube%')->first('id')->id,
        ]);
    }

    public function facebook(): static {
        return $this->state(fn (array $attributes) => [
            'task_type_id' => TaskType::where('name', 'like', '%facebook%')->first('id')->id,
        ]);
    }

    public function instagram(): static {
        return $this->state(fn (array $attributes) => [
            'task_type_id' => TaskType::where('name', 'like', '%instagram%')->first('id')->id,
        ]);
    }

    public function tiktok(): static {
        return $this->state(fn (array $attributes) => [
            'task_type_id' => TaskType::where('name', 'like', '%tiktok%')->first('id')->id,
        ]);
    }

    public function whatsapp(): static {
        return $this->state(fn (array $attributes) => [
            'task_type_id' => TaskType::where('name', 'like', '%whatsapp%')->first('id')->id,
        ]);
    }
}
