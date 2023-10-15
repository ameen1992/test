<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NotesController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('notes', NotesController::class, ['except' => ['index', 'show']]);
Route::post('/change-task-status', [TaskController::class, 'changeStatus']);
Route::delete('/tasks/{task}/delete', [TaskController::class, 'destory'])->name('tasks.destroy');
