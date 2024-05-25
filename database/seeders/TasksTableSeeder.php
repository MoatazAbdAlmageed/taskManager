<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('is_admin', false)->get();
        $admins = User::where('is_admin', true)->get();
        $tasks = [];

        $count = 100000;
        dump("creating $count task");
        for ($i = 0; $i < $count; $i++) {
            $user = $users->random();
            $admin = $admins->random();
            $tasks[] = [
                'title' => 'Task ' . ($i + 1),
                'description' => 'This is a sample task description.',
                'assigned_to_id' => $user->id,
                'assigned_by_id' => $admin->id
            ];
        }

        $chunks = array_chunk($tasks, 100);
        foreach ($chunks as $chunk) {
            Task::insert($chunk);
        }
    }
}
