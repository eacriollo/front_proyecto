<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
   
    public function index()
    {
        //
        $producto = Producto::orderBy('id', 'desc')-> get();

        return response()->json($producto, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // validar actividad

         $request->validate([
            "nombre"=> "required|unique:productos"
        ]);
        // guardar actividad 
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->inventario = $request->inventario;
        $producto->codigo = $request->codigo;
        $producto->accesorio = $request->accesorio;
        $producto->save();

        return response()->json(["mensaje" => "producto guardado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $producto = Producto::find($id);
        return response()->json($producto, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // validar actividad
          $request->validate([
            "nombre"=> "required|unique:productos,nombre,$id"
        ]);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->inventario = $request->inventario;
        $producto->codigo = $request->codigo;
        $producto->accesorio = $request->accesorio;
        $producto->update();
        return response()->json(["mensaje" => "producto modificado"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return response()->json(["mensaje" => "producto eliminado"], 200);
    }
}
