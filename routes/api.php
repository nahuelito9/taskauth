<?php

use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Api\TaskApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tareas', function () {
    return Task::all();
});



Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }

    $token = $user->createToken('token-api')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tareas', [TaskApiController::class, 'index']);
    Route::post('/tareas', [TaskApiController::class, 'store']);
    Route::patch('/tareas/{id}/completar', [TaskApiController::class, 'complete']);
    Route::delete('/tareas/{id}', [TaskApiController::class, 'destroy']);
});