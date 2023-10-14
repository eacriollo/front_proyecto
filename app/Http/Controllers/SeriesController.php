<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Producto;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $buscador = isset($request->q)?$request->q : '';

        if ($buscador) {
            # code...
            $productos = Equipo::ordeBy('id', 'desc')
                                 ->where('serie', 'like', '%'.$buscador.'%')
                                 ->paginate(10);
        } else {
            $productos = Equipo::orderBy('id', 'desc')
                                ->paginate(10);
        }
        
        return response()->json($productos, 200);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar
        $request->validate([

            "serie" => "required|unique:equipos",
            "producto_id" => "required",
            "estado_id" => "required",
            "orden_id" => "required"
        ]);

        //guardar

        $equipo =new Equipo();
        $equipo->serie = $request->serie;
        $equipo->producto_id = $request->producto_id ;
        $equipo->estado_id = $request->estado_id;
        $equipo->orden_id = $request->orden_id;
        $equipo->save();
        
        //respuesta
        return response()->json(["mensaje" => "Equipo guardado"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
