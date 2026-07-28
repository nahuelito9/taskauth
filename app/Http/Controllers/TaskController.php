<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tareas = auth()->user()->tasks;
        return view('tareas', ['tareas' => $tareas]);
    }

    public function store(Request $request)
    {
        auth()->user()->tasks()->create([
            'title' => $request->title,
            'completed' => false,
        ]);

        return redirect('/tareas');
    }

    public function complete($id)
    {
        $tarea = auth()->user()->tasks()->findOrFail($id);
        $tarea->completed = true;
        $tarea->save();

        return redirect('/tareas');
    }

    public function destroy($id)
    {
        $tarea = auth()->user()->tasks()->findOrFail($id);
        $tarea->delete();

        return redirect('/tareas');
    }
}