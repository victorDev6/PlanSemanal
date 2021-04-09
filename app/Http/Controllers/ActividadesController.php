<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActividadesController extends Controller {

    public function index(Request $request) {
        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();

        if ($request->busqueda != null) {
            session(['semana' => $request->busqueda]);
        }
        $semana = session('semana');

        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();
        return view('layouts.inicioActividades', compact('organos','actividades', 'semana'));
    }

    public function store(Request $request) {
        $id_dpto = DB::table('organos')->where('organos.id', '=', Auth::user()->id_organo)->get();
        $organo = DB::table('organos')->where('organos.id', '=', $id_dpto[0]->id_parent)->get();

        $actividad = new Actividades();
        $actividad->fecha = $request->fecha;
        $actividad->asunto = $request->asunto;
        $actividad->area_responsable = Auth::user()->id_area;
        $actividad->actividad = $request->actividad;
        $actividad->status = $request->status;
        $actividad->observaciones = $request->observaciones;
        $actividad->semana = $request->semana;
        $actividad->tipo_actividad = $request->tipo_actividad;
        $actividad->id_organo = $organo[0]->id;
        $actividad->id_departamento = $id_dpto[0]->id;
        $actividad->iduser_created = Auth::user()->id;
        $actividad->save();
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD GUARDADA EXITOSAMENTE');
    }

    public function update(Request $request, $id, $semana) {
        Actividades::where('id', '=', $id)
            ->update([
                'status' => $request->$id
            ]);
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

    public function destroy($id, $semana) {
        Actividades::destroy($id);
        return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD ELIMINADA EXITOSAMENTE');
    }

    public function send(Request $request) {
        $date = date('Y-m-d');
        Actividades::where('semana', '=', $request->semanaE)
            ->update([
                'fecha_enviado' => $date
            ]);
        return redirect()->route('actividades.inicio')->with('success', sprintf('ACTIVIDADES DE LA SEMANA %s ENVIADAS CORRECTAMENTE', $request->semanaE));
    }
}
