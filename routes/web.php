<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/tareas', [TaskController::class, 'index']);
    Route::post('/tareas', [TaskController::class, 'store']);
    Route::patch('/tareas/{id}/completar', [TaskController::class, 'complete']);
    Route::delete('/tareas/{id}', [TaskController::class, 'destroy']);
});

require __DIR__.'/settings.php';
