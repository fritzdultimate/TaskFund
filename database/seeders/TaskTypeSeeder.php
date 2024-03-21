<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taskTypes = config('tasktypes');

        TaskType::factory(count($taskTypes))
            ->state(function () use (&$taskTypes) {
                return array_shift($taskTypes) ?? [];
            })
            ->create();
    }
}
