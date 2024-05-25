<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        return view('tasks.index');
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $task = Task::create($validated);
        if (!$task) {
            return back()->with('error', 'Failed to create task. Please try again.');
        }
        return redirect('tasks')->with('success', 'Task created successfully!');

    }

    public function create()
    {
        $users = User::where('is_admin', true)->get();
        $admins = User::where('is_admin', true)->get();
        return view('tasks.create', compact('users', 'admins'));
    }

    public function statistics()
    {
        $users = User::where('is_admin', false)
            ->withCount('tasks')
            ->orderBy('tasks_count', 'desc')
            ->limit(10)
            ->get();

        return view('statistics', compact('users'));
    }

}
