<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class DefaultTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();
        $tasks = [
            [
                'description' => 'Task1',
                'status' => 1,
                'assignee' => 'Dev 1',
            ],
            [
                'description' => 'Task1',
                'status' => 1,
                'assignee' => 'Dev 1',
            ],
            [
                'description' => 'Task1',
                'status' => 1,
                'assignee' => 'Dev 1',
            ],
        ];
        Task::insert($tasks);
    }
}
