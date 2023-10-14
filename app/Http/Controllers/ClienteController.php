<?php

namespace App\Http\Controllers;

use App\Models\Abonado;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         //
         $buscador = isset($request->q)?$request->q : '';

         if ($buscador) {
             # code...
             $productos = Abonado::ordeBy('id', 'desc')
                                  ->where('nombre', 'like', '%'.$buscador.'%')
                                  //->with("colocar con que tabla se quiere extraer los datos colocar tambien en la respuesta ")
                                  ->paginate(10);
         } else {
             $productos = Abonado::orderBy('id', 'desc')
                                 ->paginate(10);
         }
         
         return response()->json($productos, 200);
         
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //validar
        $request->validate([

            "codigo" => "required",
            "plan" => "required|unique:abonados",
            "nombre" => "required"
        ]);

        //guardar

        $abonado =new Abonado();
        $abonado->codigo = $request->codigo;
        $abonado->plan = $request->plan;
        $abonado->nombre = $request->nombre;
        $abonado->save();
        
        //respuesta
        return response()->json(["mensaje" => "Abonado guardado"],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $abonado = Abonado::findOrfail($id);
        return response()->json($abonado, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //validar
        $request->validate([

            "codigo" => "required",
            "plan" => "required|unique:abonados",
            "nombre" => "required"
        ]);

        $abonado = Abonado::findOrfail($id);

        $abonado->codigo = $request->codigo;
        $abonado->plan = $request->plan;
        $abonado->nombre = $request->nombre;
        $abonado->update();

        return response()->json(["mensaje" => "Abonado actualizado"],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $abonado = Abonado::findOrfail($id);
        $abonado->delete();

        return response()->json(["mensaje" => "Abonado eliminado"],200);

    }
}
