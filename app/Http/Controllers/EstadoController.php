<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $estado = Estado::orderBy('id', 'desc')-> get();

        return response()->json($estado, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar

        $request->validate([
            "estado" => "required|unique:estados"
        ]);

        // guardar
        $estado = new Estado();
        $estado->estado = $request->estado;
        $estado->save();

        return response()->json(["mensaje" => "estado guardado"], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $estado = Estado::find($id);
        return response()->json($estado, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "estado" => "required|unique:estados,estado,$id"
        ]);

        //actualizamos

        $estado = Estado::find($id);
        $estado->estado = $request->estado;
        $estado->update();

        return response()->json(["mensaje" => "estado actualizado"], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $estado = Estado::find($id);
        $estado->delete();

        return response()->json(["mensaje" => "estado elimindao"], 200);
    }
}
