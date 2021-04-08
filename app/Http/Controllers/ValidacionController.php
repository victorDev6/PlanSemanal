<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ValidacionController extends Controller {

    public function index(Request $request) {
        $administrativo = $request->area;
        $semana = $request->semana;
        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();
        $actividad2 = $request->actividad2;

        if ($actividad2 == null) {
            $actividades = Actividades::where('id_departamento', '=', $request->area)
                ->where('semana', '=', $request->semana)
                ->where('fecha_vToBueno', '!=', null)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                // ->orderByDesc('actividades.id')
                ->orderByRaw('status_validacion desc')
                ->get();
        } else {
            $actividades = Actividades::where('id_departamento', '=', $request->area)
            ->where('semana', '=', $request->semana)
            ->where('tipo_actividad', '=', $actividad2)
            ->where('fecha_vToBueno', '!=', null)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            // ->orderByDesc('actividades.id')
            ->orderByRaw('status_validacion desc')
            ->get();
        }
        return view('layouts.inicioValidacion', compact('organo', 'areas', 'actividades', 'administrativo', 'semana', 'actividad2'));
    }

    public function store(Request $request) {

        if ($request->actividades != null) {
            $date = date('Y-m-d');
            foreach ($request->actividades as $actividad) {
                Actividades::where('id', '=', $actividad)
                    ->update([
                        'status_validacion' => 'ADMINISTRATIVO',
                        'fecha_validacion' => $date
                    ]);
            }
        }

        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();
        $actividad2 = $request->tipo_act;

        if ($actividad2 == null) {
            $actividades = Actividades::where('id_departamento', '=', $request->administrativo)
                ->where('semana', '=', $request->semana)
                ->where('fecha_vToBueno', '!=', null)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                // ->orderByDesc('actividades.id')
                ->orderByRaw('status_validacion desc')
                ->get();
        } else {
            $actividades = Actividades::where('id_departamento', '=', $request->administrativo)
                ->where('semana', '=', $request->semana)
                ->where('tipo_actividad', '=', $actividad2)
                ->where('fecha_vToBueno', '!=', null)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                // ->orderByDesc('actividades.id')
                ->orderByRaw('status_validacion desc')
                ->get();
        }
        
        return view('layouts.inicioValidacion')
            ->with('organo', $organo)
            ->with('areas', $areas)
            ->with('actividades', $actividades)
            ->with('administrativo', $request->administrativo)
            ->with('semana', $request->semana)
            ->with('actividad2', $actividad2)
            ->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');

        // return redirect()->route('validacion.inicio')->with('success', 'ACTIVIDADES ENVIADAS CORRECTAMENTE');
    }

}
