<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Services\UpdateNoteService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Inertia\Response as InertiaResponse;

class NotesController extends Controller
{
    public function create(): InertiaResponse
    {
        return Inertia::render('notes-create');
    }

    public function store(StoreNoteRequest $request): RedirectResponse
    {
        $note = Note::create([
            'tittle' => $request->get('tittle')
        ]);

        $note->tasks()->createMany($request->get('tasks'));

        return to_route('home');
    }

    public function edit(Request $request, Note $note): InertiaResponse
    {
        return Inertia::render('notes-create', [
            'isEdit' => true,
            'note' => $note->load('tasks')
        ]);
    }

    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        UpdateNoteService::handle($note, $request->get('tittle'), collect($request->get('tasks')));

        return to_route('home');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->tasks()->delete();

        $note->delete();

        return to_route('home');
    }
}
