<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('tasks.index');
    }

    public function store(TaskRequest $request)
    {

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to_id' => $request->assigned_to_id,
            'assigned_by_id' => auth()->id(),
        ]);

        if (!$task) {
            return back()->with('error', 'Failed to create task. Please try again.');
        }
        return redirect('tasks');
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        return view('tasks.create', compact('users'));
    }
}
