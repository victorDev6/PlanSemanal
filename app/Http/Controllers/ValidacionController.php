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
        /* $actividades = Actividades::Validacion($request->get('area'), $request->get('semana'))
            ->where('actividades.id_departamento', '=', $organo1)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get(); */

        $actividades = Actividades::where('id_departamento', '=', $request->area)
            ->where('semana', '=', $request->semana)
            ->where('fecha_vToBueno', '!=', null)
            // ->where('actividades.id_departamento', '=', $organo1)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();
        return view('layouts.inicioValidacion', compact('organo', 'areas', 'actividades', 'administrativo', 'semana'));
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

        $actividades = Actividades::where('id_departamento', '=', $request->administrativo)
            ->where('semana', '=', $request->semana)
            ->where('fecha_vToBueno', '!=', null)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

            return view('layouts.inicioValidacion')
                ->with('organo', $organo)
                ->with('areas', $areas)
                ->with('actividades', $actividades)
                ->with('administrativo', $request->administrativo)
                ->with('semana', $request->semana)
                ->with('success', 'ACTIVIDADES ENVIADAS EXITOSAMENTE!');

        // return redirect()->route('validacion.inicio')->with('success', 'ACTIVIDADES ENVIADAS CORRECTAMENTE');
    }

}
