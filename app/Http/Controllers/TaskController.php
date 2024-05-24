<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        return view('dashboard', compact('tasks'));
    }

    public function create(TaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to_id' => $request->assigned_to_id,
            'assigned_by_id' => auth()->id(),
        ]);

        if (!$task) {
            throw new \Exception('Failed to create task. Please try again.');
        }
        return redirect()->route('tasks');
    }
}
