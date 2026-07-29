<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->tasks;
    }

    public function store(Request $request)
            {
                $request->validate([
                    'title' => 'required|string|max:255',
                ]);

                $tarea = $request->user()->tasks()->create([
                    'title' => $request->title,
                    'completed' => false,
                ]);

                return response()->json($tarea, 201);
            }

            public function complete(Request $request, $id)
                {
                    $tarea = $request->user()->tasks()->findOrFail($id);
                    $tarea->completed = true;
                    $tarea->save();

                    return response()->json($tarea);
                }

                public function destroy(Request $request, $id)
                    {
                        $tarea = $request->user()->tasks()->findOrFail($id);
                        $tarea->delete();

                        return response()->json(['message' => 'Tarea eliminada']);
                    }
}