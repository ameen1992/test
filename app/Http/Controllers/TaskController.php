<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function changeStatus(Request $request)
    {
        $validatedData = $request->validate([
            'taskId' => 'required|integer',
        ]);

        $task = Task::FindOrFail($validatedData['taskId']);
        $task->status = !$task->status;
        $task->save();
    }
}
