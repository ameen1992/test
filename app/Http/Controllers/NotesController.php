<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotesController extends Controller
{
    public function create()
    {
        return Inertia::render('notes-create');
    }

    public function store(StoreNoteRequest $request)
    {
        $note = Note::create([
            'tittle' => $request->get('tittle')
        ]);

        $note->tasks()->createMany($request->get('tasks'));

        return to_route('home');
    }

    public function edit(Request $request, Note $note)
    {
        return Inertia::render('notes-create', [
            'isEdit' => true,
            'note' => $note->load('tasks')
        ]);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update([
            'tittle' => $request->get('tittle')
        ]);

        list($oldTasks, $newTasks) = collect($request->get('tasks'))->partition(function ($item) {
            return isset($item['id']);
        });

        foreach ($oldTasks as $oldTask) {
            $task = Task::find($oldTask['id']);
            $task->update([
                'name' => $oldTask['name'],
                'status' => $oldTask['status'],
            ]);
            $task->save();
        }

        $note->tasks()->createMany($newTasks);

        return to_route('home');
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return to_route('home');
    }
}
