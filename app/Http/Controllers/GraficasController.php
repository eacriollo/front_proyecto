<?php

namespace App\Http\Controllers;

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
        
        $respuesta = $ordenes->map(function ($orden){
            return[
                'tipo_de_actividad'=> $orden->actividad->tipo,
                'total_suma'=> $orden->total_precio
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
        
        $respuesta = $ordenes->map(function ($orden){
            return[
                'ciudad'=> $orden->ciudad->nombre,
                'total_suma'=> $orden->total_precio
            ];
        });

        return response()->json($respuesta, 200);
    }
    
}


