<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{

    public function test_a_task_can_be_created(): void
    {
        $user = User::create([
            'name' => "user",
            'email' => "user@user.com",
            'password' => Hash::make('password'),
        ]);

        $task = Task::factory()->make([
            'title' => 'Test Task',
            'description' => 'This is a test task description',
            'assigned_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ]);

        $this->assertTrue($task->save());
    }


    public function test_title_is_required()
    {
        $user = User::create([
            'name' => "user2",
            'email' => "user2@user.com",
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);
        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'title' => null,
            'description' => 'Test description',
            'assigned_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_description_is_required()
    {
        $user = User::create([
            'name' => "user3",
            'email' => "user3@user.com",
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);
        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'title' => "title",
            'assigned_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ]);

        $response->assertSessionHasErrors(['description']);
    }

    public function test_non_admin_cannot_create_task()
    {
        $user = User::factory()->create([
            'name' => "user6",
            'email' => "user6@user.com",
            'password' => Hash::make('password'),
        ]);


        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Test description',
            'assigned_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ]);

        $response->assertRedirect();
        $response->assertStatus(302);
    }

    public function test_admin_can_create_task()
    {
        $user = User::factory()->create([
            'name' => "admin3",
            'email' => "admin3@user.com",
            'password' => Hash::make('password'),
            'is_admin' => 1, // Ensure the user is an admin
        ]);

        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Test description',
            'assigned_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Task created successfully!');
    }
}
