<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $precio = Precio::orderBy('id', 'desc')-> get();

        return response()->json($precio, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // validar

         $request->validate([
            "precio"=> "required|unique:precios"
        ]);
        // guardar actividad 
        $precios = new Precio();
        $precios->precio = $request->precio;
        $precios->save();

        return response()->json(["mensaje" => "precio guardado"], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $precio = Precio::find($id);

        return response()->json($precio, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

         // validar precio

         $request->validate([
            "precio"=> "required|unique:precios,precio,$id"
        ]);

        $precios = Precio::find($id);
        $precios->precio = $request->precio;
        $precios->update();

        return response()->json(["mensaje" => "precio actualizado"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
        $precios = Precio::find($id);
        $precios-> delete(); 
        return response()->json(["mensaje" => "se elimino item"], 200); 
    }
}
