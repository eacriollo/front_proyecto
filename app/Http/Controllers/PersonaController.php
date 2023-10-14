<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $persona = Persona::orderBy('id', 'desc')-> get();

        return response()->json($persona, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // validar

        $request->validate([
            "nombre"=> "required|unique:personas",
            "ci" => "required"
        ]);
        // guardar actividad 
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->ci= $request->ci;
        $persona->save();

        return response()->json(["mensaje" => "persona guardada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $persona = Persona::find($id);

        return response()->json($persona, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         // validar precio

         $request->validate([
            
            "nombre"=> "required|unique:personas,nombre,$id",
            "ci" => "required"
        ]);

        $persona = Persona::find($id);
        $persona->nombre = $request->nombre;
        $persona->ci = $request->ci;
        $persona->update();

        return response()->json(["mensaje" => "persona actualizada"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $persona = Persona::find($id);
        $persona-> delete(); 
        return response()->json(["mensaje" => "se elimino"], 200); 
    }
}
