<?php

namespace App\Services;

use App\Models\Note;
use App\Models\Task;
use Illuminate\Support\Collection;

class UpdateNoteService
{
    public static function handle(Note $note, $tittle, Collection $tasks): void
    {
        $note->update([
            'tittle' => $tittle
        ]);

        list($oldTasks, $newTasks) = $tasks->partition(function ($item) {
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
    }
}