<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividad = Actividad::orderBy('id', 'desc')-> get();

        return response()->json($actividad, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // validar actividad

            $request->validate([
                "tipo"=> "required|unique:actividads"
            ]);
            // guardar actividad 
            $act = new Actividad();
            $act->tipo = $request->tipo;
            $act->save();

            return response()->json(["mensaje" => "actividad guardada"], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $act = Actividad::find($id);

        return response()->json($act, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // validar actividad

            $request->validate([
                "tipo"=> "required|unique:actividads,tipo,$id"
            ]);

            $act = Actividad::find($id);
            $act->tipo = $request->tipo;
            $act->update();

            return response()->json(["mensaje" => "actividad modificada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $act = Actividad::find($id);
        $act-> delete(); 
        return response()->json(["mensaje" => "actividad eliminada"], 200);  
    }
}
