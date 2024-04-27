<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::all();
        return response()->json(['tareas' => $tareas], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:255',
            'ejecutada' => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tarea = Tarea::create($request->all());

        return response()->json(['tarea' => $tarea], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);
        return response()->json(['tarea' => $tarea], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string|max:255',
            'ejecutada' => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());

        return response()->json(['tarea' => $tarea], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return response()->json(['message' => 'Tarea eliminada exitosamente.'], 200);
    }
}
