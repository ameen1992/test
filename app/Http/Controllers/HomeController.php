<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::with('tasks')->paginate();
        return Inertia::render('home', ['notes' => $notes]);
    }
}
