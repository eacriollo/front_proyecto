<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Orden;
use Illuminate\Http\Request;
use DB;
use Symfony\Component\Console\Input\Input;

class GraficasController extends Controller
{
    //
    /*public function ordenes(Request $request)
    {
        $year = $request->q;
        $mes = $request->mes;

        $ordenes = Orden::whereYear('fecha', $year)
        ->whereMonth('fecha', $mes)
        ->get();
            

        return response()->json($ordenes, 200);
    }*/

    public function ordenes(Request $request)
    {
        $year = $request->q;
        $mes = $request->mes;

        $ordenes = Orden::select('actividad_id', DB::raw('SUM(precios.precio) as total_precio'))
            ->join('precios', 'ordens.precio_id', '=', 'precios.id')
            ->join('actividads', 'ordens.actividad_id', '=', 'actividads.id')
            ->whereYear('ordens.fecha', $year)
            ->whereMonth('ordens.fecha', $mes)
            ->groupBy('actividad_id')
            ->get();

        $respuesta = $ordenes->map(function ($orden) {
            return [
                'tipo_de_actividad' => $orden->actividad->tipo,
                'total_suma' => $orden->total_precio
            ];
        });

        return response()->json($respuesta, 200);
    }

    public function ciudad(Request $request)
    {
        $year = $request->q;
        $mes = $request->mes;

        $ordenes = Orden::select('ciudad_id', DB::raw('SUM(precios.precio) as total_precio'))
            ->join('precios', 'ordens.precio_id', '=', 'precios.id')
            ->join('ciudads', 'ordens.ciudad_id', '=', 'ciudads.id')
            ->whereYear('ordens.fecha', $year)
            ->whereMonth('ordens.fecha', $mes)
            ->groupBy('ciudad_id')
            ->get();

        $respuesta = $ordenes->map(function ($orden) {
            return [
                'ciudad' => $orden->ciudad->nombre,
                'total_suma' => $orden->total_precio
            ];
        });

        return response()->json($respuesta, 200);
    }

    public function tecnico(Request $request)
    {
        $year = $request->q;
        $mes = $request->mes;
        $persona = $request->persona;

        $ordenes = Orden::select('persona_id', 'actividad_id', DB::raw('SUM(precios.precio) as total_precio'))
            ->join('precios', 'ordens.precio_id', '=', 'precios.id')
            ->join('actividads', 'ordens.actividad_id', '=', 'actividads.id')
            ->whereYear('ordens.fecha', $year)
            ->whereMonth('ordens.fecha', $mes)
            ->where('ordens.persona_id', $persona)
            ->groupBy('persona_id', 'actividad_id')
            ->with(['persona', 'actividad'])
            ->get();



        $respuesta = $ordenes->map(function ($orden) {
            return [
                'persona' => $orden->persona->nombre,
                'tipo_de_actividad' => $orden->actividad->tipo,
                'total_suma' => $orden->total_precio
            ];
        });

        return response()->json($respuesta, 200);
    }


    public function ordenesPorFecha(Request $request)
    {
        $finicio = $request->q;
        $ffin = $request->ffin;

        $ordenes = Orden::whereBetween('fecha', [$finicio,  $ffin])
            ->join('precios', 'ordens.precio_id', '=', 'precios.id')
            ->join('actividads', 'ordens.actividad_id', '=', 'actividads.id')
            ->join('abonados', 'ordens.abonado_id', '=', 'abonados.id')
            ->select(
                'ordens.id',
                'ordens.fecha',
                'actividads.tipo as tipo_de_actividad',
                'precios.precio as precio',
                'abonados.codigo as codigo',
                'abonados.nombre as nombre',
                'abonados.plan as plan',
                'ordens.ticket',
                'ordens.acta'
            )

            ->get();

        $respuesta = $ordenes->map(function ($orden) {
            return [
                'tipo_de_actividad' => $orden->tipo_de_actividad,
                'precios' => $orden->precio,
                'fecha' => $orden->fecha,
                'codigo' => $orden->codigo,
                'nombre' => $orden->nombre,
                'plan' => $orden->plan,
                'ticket' => $orden->ticket,
                'acta' => $orden->acta
            ];
        });

        return response()->json($respuesta, 200);
    }


    public function equiposPorFecha(Request $request)
    {
        $finicio = $request->q;
        $ffin = $request->ffin;
        
        $ordenes = Equipo::whereBetween('equipos.updated_at', [$finicio,  $ffin])
            ->join('abonados', 'equipos.abonado_id', '=', 'abonados.id')
            ->join('productos', 'equipos.producto_id', '=', 'productos.id')
            ->join('estados', 'equipos.estado_id', '=', 'estados.id')
            ->join('personas', 'equipos.persona_id', '=', 'personas.id')
            ->select(
                'equipos.id',
                'productos.nombre as equipo',
                'equipos.serie',
                'abonados.plan as plan',
                'abonados.codigo as codigo',
                'personas.nombre as nombre',
                'productos.accesorio as accesorio',
                'estados.estado as estado'
             
            )
        
            ->get();
        
        $respuesta = $ordenes->map(function ($orden) {
            return [
                'id' => $orden->id,
                'equipo' => $orden->equipo,
                'serie' => $orden->serie,
                'plan'=> $orden->plan,
                'codigo'=> $orden->codigo,
                'accesorio' => $orden->accesorio,
                'tecnico'=> $orden->nombre,
                'estado' => $orden->estado
               
            ];
        });
        
        return response()->json($respuesta, 200);
    }
}


