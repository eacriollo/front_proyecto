<?php

namespace App\Http\Controllers;

use App\Models\Equipo;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    
    public function index(Request $request)
    {
        //Variables que se recibe por url
        $buscar = isset($request->q) ? $request->q : '';
        $limit = isset($request->limit) ? $request->limit : 10;
        // logica si en la url viene un dato
        if ($buscar) {
            # code...
            $productos = Equipo::orderBy('id', 'desc')
                                ->where('serie', 'like', '%' .$buscar. '%')
                                ->with("Persona", "Producto", "Abonado", "Estado")
                                ->paginate($limit);
        } else {
            $productos = Equipo::orderBy('id', 'desc')->with("Persona", "Producto", "Abonado", "Estado")
                ->paginate($limit);
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
            "persona_id" => "required"
        ]);
        //guardar
        $equipo = new Equipo();
        $equipo->serie = $request->serie;
        $equipo->producto_id = $request->producto_id;
        $equipo->estado_id = $request->estado_id;
        $equipo->persona_id = $request->persona_id;
        $equipo->abonado_id = $request->abonado_id;
        $equipo->save();

        //respuesta
        return response()->json(["mensaje" => "Equipo guardado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipo::find($id);
        return response()->json($equipo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validar
        $request->validate([
            "serie" => "required|unique:equipos,serie,$id",
            "producto_id" => "required",
            "estado_id" => "required",
            "persona_id" => "required"
        ]);

        $equipo = Equipo::find($id);
        $equipo->serie = $request->serie;
        $equipo->producto_id = $request->producto_id;
        $equipo->estado_id = $request->estado_id;
        $equipo->persona_id = $request->persona_id;
        $equipo->abonado_id = $request->abonado_id;
        $equipo->update();

        return response()->json(["mensaje" => "esquipo actualizado"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $equipo = Equipo::find($id);
        $equipo->delete();

        return response()->json(["mensaje" => "Equipo eliminado"], 200);
    }
}
