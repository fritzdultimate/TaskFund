<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = config('links');

        Task::factory(count($tasks))
            ->state(function () use (&$tasks) {
                return array_shift($tasks) ?? [];
            })
            ->create();
    }
}
