<?php

namespace App\Http\Controllers;

use App\Actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VtoBuenoController extends Controller {

    public function index(Request $request) {
        $organo1 = Auth::user()->id_area;
        if ($organo1 == 3) {
            $organo1 = 5;
        }
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();

        if ($request->semana != null) {
            session(['semana' => $request->semana]);
            session(['actividad2' => $request->actividad2]);
        }

        $semana = session('semana');
        $actividad2 = session('actividad2');

        if ($actividad2 == null) {
            $actividades = Actividades::where('id_departamento', '=', $organo1)
                ->where('semana', '=', $semana)
                ->where('fecha_enviado', '!=', null)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                // ->orderByDesc('actividades.id')
                ->orderByRaw('status_vtoBueno desc')
                ->get();
        } else {
            $actividades = Actividades::where('id_departamento', '=', $organo1)
                ->where('semana', '=', $semana)
                ->where('tipo_actividad', '=', $actividad2)
                ->where('fecha_enviado', '!=', null)
                ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
                ->select('actividades.*', 'organos.descripcion')
                // ->orderByDesc('actividades.id')
                ->orderByRaw('status_vtoBueno desc')
                ->get();
        }
        return view('layouts.inicioVtoBueno', compact('organo', 'areas', 'semana', 'actividades', 'actividad2'));
    }

    public function store(Request $request, $semana) {
        if ($request->actividades != null) {
            $date = date('Y-m-d');
            foreach ($request->actividades as $actividad) {
                Actividades::where('id', '=', $actividad)
                    ->update([
                        'status_vtoBueno' => 'ADMINISTRATIVO',
                        'fecha_vToBueno' => $date
                    ]);
            }
        }
        return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');
    }

    public function update(Request $request) {
        Actividades::where('id', '=', $request->id)
            ->update([
                'asunto' => $request->asunto,
                'actividad' => $request->actividad,
                'observaciones' => $request->observaciones,
                'semana' => $request->semanaF,
                'status' => $request->status,
                'tipo_actividad' =>$request->tipo_actividad
            ]);
        return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

}
