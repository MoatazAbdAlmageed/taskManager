<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        for ($i = 0; $i < 100; $i++) { // Seed 100 tasks
            $user = $users->random();
            Task::create([
                'title' => 'Task ' . ($i + 1),
                'description' => 'This is a sample task description.',
                'assigned_to_id' => $user->id,
                'assigned_by_id' => User::where('is_admin', true)->first()->id,
            ]);
        }
    }
}
