<?php

namespace App\Http\Controllers;

use App\Actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VtoBuenoController extends Controller {
    public function index(Request $request) {
        //
        // dd(Auth::user()->id_area);
        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();
        $semana = $request->semana;

        $actividades = Actividades::where('id_departamento', '=', $organo1)
            ->where('semana', '=', $request->semana)
            ->where('fecha_enviado', '!=', null)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioVtoBueno', compact('organo', 'areas', 'semana', 'actividades'));
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

        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();

        $actividades = Actividades::where('id_departamento', '=', $organo1)
            ->where('semana', '=', $semana)
            ->where('fecha_enviado', '!=', null)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioVtoBueno')
            ->with('organo', $organo)
            ->with('areas', $areas)
            ->with('semana', $semana)
            ->with('actividades', $actividades)
            ->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');

        // return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');
    }

    public function update(Request $request) {
        Actividades::where('id', '=', $request->id)
            ->update([
                'asunto' => $request->asunto,
                'actividad' => $request->actividad,
                'observaciones' => $request->observaciones,
                'semana' => $request->semanaF,
                'status' => $request->status
            ]);
        
        $organo1 = Auth::user()->id_area;
        $organo = DB::table('organos')->where('organos.id', '=', $organo1)->get();
        $areas = DB::table('organos')->where('id_parent', '=', $organo1)->get();
        $semana = $request->semanaF;

        $actividades = Actividades::where('id_departamento', '=', $organo1)
            ->where('semana', '=', $semana)
            ->where('fecha_enviado', '!=', null)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioVtoBueno')
                ->with('organo', $organo)
                ->with('areas', $areas)
                ->with('semana', $semana)
                ->with('actividades', $actividades)
                ->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE!');

        // return redirect()->route('vtoBueno.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

}
