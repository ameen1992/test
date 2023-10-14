<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('notes', NotesController::class, ['except' => ['index', 'show']]);
Route::post('/change-task-status', [TaskController::class, 'changeStatus']);
