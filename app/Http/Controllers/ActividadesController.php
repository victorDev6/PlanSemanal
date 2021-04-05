<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActividadesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();
        // $areas = DB::table('organos')->where('id_parent', '=', $responsable)->get();
        $semana = $request->busqueda;

        $actividades = Actividades::where('semana', '=', $request->busqueda)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

            // areas
        return view('layouts.inicioActividades', compact('organos','actividades', 'semana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $id_dpto = DB::table('organos')->where('organos.id', '=', Auth::user()->id_organo)->get();
        $organo = DB::table('organos')->where('organos.id', '=', $id_dpto[0]->id_parent)->get();

        $actividad = new Actividades();
        $actividad->fecha = $request->fecha;
        $actividad->asunto = $request->asunto;
        // $actividad->area_responsable = $request->area_responsable;
        $actividad->area_responsable = Auth::user()->id_area;
        $actividad->actividad = $request->actividad;
        $actividad->status = $request->status;
        $actividad->observaciones = $request->observaciones;
        $actividad->semana = $request->semana;
        $actividad->id_organo = $organo[0]->id;
        $actividad->id_departamento = $id_dpto[0]->id;
        $actividad->save();

        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();
        $semana = $request->semana;
        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();
        
        
        return view('layouts.inicioActividades')
            ->with('organos', $organos)
            ->with('actividades', $actividades) 
            ->with('semana', $semana)
            ->with('success', 'ACTIVIDAD GUARDADA EXITOSAMENTE!');
        // return view('layouts.inicioActividades', compact('organos','actividades', 'semana'))->with('success', 'ACTIVIDAD GUARDADA EXITOSAMENTE');
        // return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD GUARDADA EXITOSAMENTE');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $semana) {

        Actividades::where('id', '=', $id)
            ->update([
                'status' => $request->$id
            ]);
        
        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();
        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioActividades')
            ->with('organos', $organos)
            ->with('actividades', $actividades) 
            ->with('semana', $semana)
            ->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE!');
        // return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD MODIFICADA EXITOSAMENTE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $semana) {
        Actividades::destroy($id);

        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();
        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioActividades')
            ->with('organos', $organos)
            ->with('actividades', $actividades) 
            ->with('semana', $semana)
            ->with('success', 'ACTIVIDAD ELIMINADA EXITOSAMENTE!');
        // return redirect()->route('actividades.inicio')->with('success', 'ACTIVIDAD ELIMINADA EXITOSAMENTE');
    }

    public function send(Request $request) {
        $date = date('Y-m-d');
        Actividades::where('semana', '=', $request->semanaE)
            ->update([
                'fecha_enviado' => $date
            ]);

        $responsable = Auth::user()->id_area;
        $organos = DB::table('organos')->where('organos.id', '=', $responsable)->get();
        $semana = $request->semanaE;
        $actividades = Actividades::where('semana', '=', $semana)
            ->where('actividades.area_responsable', '=', $responsable)
            ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

        return view('layouts.inicioActividades')
            ->with('organos', $organos)
            ->with('actividades', $actividades) 
            ->with('semana', $semana)
            ->with('success', 'ACTIVIDAD ENVIADAS EXITOSAMENTE!');

        // return redirect()->route('actividades.inicio')->with('success', sprintf('ACTIVIDADES DE LA SEMANA %s ENVIADAS CORRECTAMENTE', $request->semanaE));
    }
}
