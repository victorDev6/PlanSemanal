<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\organo;
use Carbon\Carbon;
use DateTime;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PlanSemanalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $areas = DB::table('organos')->where('id_parent', '=', 2)->orWhere('id_parent', '=', 3)->get();
        $subAreas = DB::table('organos')->where('id_parent', '=', $request->area)->get();

        $lunes = []; $martes = []; $miercoles = []; $jueves = []; $viernes = [];
        $mes = $request->mes;
        $direccion = $request->area;
        $semana = $request->semana;
        $ejercicio = $request->ejercicio;

        if ($request->ejercicio != null){
            $actividades = DB::table('actividades')
            ->whereYear('fecha', $request->ejercicio)
            ->whereMonth('fecha', $request->mes)
            ->where('id_departamento', '=', $request->area)
            ->where('semana', '=', $request->semana)
            ->where('fecha_validacion', '!=', null)
            // ->leftjoin('organos', 'actividades.area_responsable', '=', 'organos.id')
            // ->select('actividades.*', 'organos.descripcion')
            ->orderByDesc('actividades.id')
            ->get();

            // recorrer el array y separar por dias
            foreach ($actividades as $actividad) {
                $day = Carbon::parse($actividad->fecha)->format('l');
                switch ($day) {
                    case 'Monday':
                        array_push($lunes, $actividad);
                        break;
                    case 'Tuesday':
                        array_push($martes, $actividad);
                        break;
                    case 'Wednesday':
                        array_push($miercoles, $actividad);
                        break;
                    case 'Thursday':
                        array_push($jueves, $actividad);
                        break;
                    case 'Friday':
                        array_push($viernes, $actividad);
                        break;
                }
            }
        }

        return view('layouts.inicioPlanSemanal', compact('areas', 'subAreas', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'mes', 'direccion', 'semana', 'ejercicio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
    public function update(Request $request, $id) {
        $date = date('Y-m-d');
        Actividades::where('id', '=', $id)
            ->update([
                'ind_direccion' => $request->indicaciones,
                'fecha_direccion' => $date
            ]);
        return back()->withInput()->with('success', 'SE GUARDARON LOS CAMBIOS CORRECTAMENTE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function reporteSemanal($ejercicio, $mes, $direccion, $semana) {
        $direccion2 = organo::where('id', '=', $direccion)->get();
        $subAreas = organo::where('id_parent', '=', $direccion)->get();

        $lunes = []; $martes = []; $miercoles = []; $jueves = []; $viernes = [];
        if ($ejercicio != null){
            $actividades = DB::table('actividades')
            ->whereYear('fecha', $ejercicio)
            ->whereMonth('fecha', $mes)
            ->where('id_departamento', '=', $direccion)
            ->where('semana', '=', $semana)
            ->where('fecha_validacion', '!=', null)
            ->orderByDesc('actividades.id')
            ->get();

            // recorrer el array y separar por dias
            foreach ($actividades as $actividad) {
                $day = Carbon::parse($actividad->fecha)->format('l');
                switch ($day) {
                    case 'Monday':
                        array_push($lunes, $actividad);
                        break;
                    case 'Tuesday':
                        array_push($martes, $actividad);
                        break;
                    case 'Wednesday':
                        array_push($miercoles, $actividad);
                        break;
                    case 'Thursday':
                        array_push($jueves, $actividad);
                        break;
                    case 'Friday':
                        array_push($viernes, $actividad);
                        break;
                }
            }
        }

        $pdf = PDF::loadView('layouts.pdfs.reporteSemanal', compact('direccion2', 'semana', 'subAreas', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream('download.pdf');
    }
}
