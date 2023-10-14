<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $ciudad = Ciudad::orderBy('id', 'desc')-> get();

        return response()->json($ciudad, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar

        $request->validate([
            "nombre"=> "required|unique:ciudads"
        ]);
        // guardar actividad 
        $ciudad = new Ciudad();
        $ciudad->nombre = $request->nombre;
        $ciudad->save();

        return response()->json(["mensaje" => "ciudad guardada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ciudad = Ciudad::find($id);

        return response()->json($ciudad, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // validar actividad

        $request->validate([
            "nombre"=> "required|unique:ciudads,nombre,$id"
        ]);

        $ciudad = Ciudad::find($id);
        $ciudad->nombre = $request->nombre;
        $ciudad->update();

        return response()->json(["mensaje" => "ciudad actualizada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $ciudad = Ciudad::find($id);
        $ciudad-> delete(); 
        return response()->json(["mensaje" => "Ciudad eliminada"], 200); 
    }
}
