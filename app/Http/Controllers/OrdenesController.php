<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = isset($request->q) ? $request->q : '';
        $limit = isset($request->limit) ? $request->limit : 10;
        if ($buscar) {
            # code...
            $Orden = Orden::orderBy('id', 'desc')
                ->where('ticket', 'like', '%' . $buscar . '%')
                ->with("Abonado", "User", "Persona", "Precio", "Actividad", "Ciudad")
                ->paginate($limit);
        } else {
            $Orden = orden::orderBy('id', 'desc')
                ->with("Abonado", "User", "Persona", "Precio", "Actividad", "Ciudad")
                ->paginate($limit);
        }
        return response()->json($Orden, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar
        $request->validate([

            "fecha" => "required",
            "acta" => "required",
            "ticket" => "required|unique:ordens",
            "manga" => "required",
            "abonado_id" => "required",
            "user_id" => "required",
            "persona_id" => "required",
            "precio_id" => "required",
            "actividad_id" => "required",
            "ciudad_id" => "required",
        ]);

        //guardar

        $orden = new Orden();
        $orden->fecha = $request->fecha;
        $orden->acta = $request->acta;
        $orden->ticket = $request->ticket;
        $orden->manga = $request->manga;
        $orden->abonado_id = $request->abonado_id;
        $orden->user_id = $request->user_id;
        $orden->persona_id = $request->persona_id;
        $orden->precio_id = $request->precio_id;
        $orden->actividad_id = $request->actividad_id;
        $orden->ciudad_id = $request->ciudad_id;
        $orden->save();

        //respuesta
        return response()->json(["mensaje" => "orden guaradada"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $orden = Orden::find($id);
        return response()->json($orden, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //validar
        $request->validate([

            "fecha" => "required",
            "acta" => "required",
            "ticket" => "required|unique:ordens,ticket,$id",
            "manga" => "required",
            "abonado_id" => "required",
            "user_id" => "required",
            "persona_id" => "required",
            "precio_id" => "required",
            "actividad_id" => "required",
            "ciudad_id" => "required",
        ]);
        //guardar
        $orden = Orden::find($id);
        $orden->fecha = $request->fecha;
        $orden->acta = $request->acta;
        $orden->ticket = $request->ticket;
        $orden->manga = $request->manga;
        $orden->abonado_id = $request->abonado_id;
        $orden->user_id = $request->user_id;
        $orden->persona_id = $request->persona_id;
        $orden->precio_id = $request->precio_id;
        $orden->actividad_id = $request->actividad_id;
        $orden->ciudad_id = $request->ciudad_id;
        $orden->update();
        //respuesta
        return response()->json(["mensaje" => "orden actualizada"], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $orden = Orden::find($id);
        $orden->delete();

        return response()->json(["mensaje" => "Orden eliminada"], 200);
    }
}
