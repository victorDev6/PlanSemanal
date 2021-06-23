<?php

namespace App\Http\Controllers\pagos;

use App\Http\Controllers\Controller;
// use PDF;
use App\Pagos;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddPagoController extends Controller
{

    public function index()
    {
        $unidades = DB::table('unidades')->get();
        return view('layouts.pagos.agregarPago', compact('unidades'));
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except(['_token', '_method']);
        Pagos::insert($datosEvento);
    }

    public function show($id)
    {
        $data['pagos'] = Pagos::where('id_unidad', '=', $id)->get();
        return response()->json($data['pagos']);
    }

    public function update(Request $request, $id)
    {
        $respuesta = Pagos::where('id', '=', $id)->update([
            'title' => $request->title,
            'comentarios' => $request->comentarios
        ]);
        return response()->json($respuesta);
    }

    public function destroy($id)
    {
        Pagos::destroy($id);
        return response()->json($id);
    }

    public function sendPagos(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        Pagos::where('id_unidad', '=', $request->id_unidad)
            ->where('fecha_enviado', '=', null)->update([
                'fecha_enviado' => $date
            ]);
        return 'success';
    }

    public function previsualizar(Request $request)
    {
        $id = $request->txtUniPrev;
        $fechaInicio = $request->fecha_inicio;
        $fechaFinal = $request->fecha_termino;

        $unidad = DB::table('unidades')->where('id', '=', $id)->get();
        // $pagos = Pagos::where('id_unidad', '=', $id)
        //     ->whereBetween('start', [$fechaInicio, $fechaFinal])
        //     ->orderBy('start', 'ASC')->get();
        $pagosProgramados = Pagos::where('id_unidad', '=', $id)
            ->where('backgroundColor', '=', null)
            ->whereBetween('start', [$fechaInicio, $fechaFinal])
            ->orderBy('start', 'ASC')->get();
        $pagosBanca = Pagos::where('id_unidad', '=', $id)
            ->where('backgroundColor', '=', '#fceb30')
            ->whereBetween('start', [$fechaInicio, $fechaFinal])->get();
        $efectivos = Pagos::where('id_unidad', '=', $id)
            ->where('backgroundColor', '=', '#00ff04')
            ->whereBetween('start', [$fechaInicio, $fechaFinal])->get();

        $totalPagos = 0;
        foreach ($pagosProgramados as $pago) {
            $date = date_create($pago->start);
            $fecha=date_format($date, 'Y-m-d');
            $pago->start = $fecha;
            $totalPagos += $pago->title;
            /* $day = Carbon::parse($pago->start)->format('l');
            switch ($day) {
                case 'Monday': $pago->dia = 'Lunes'; break;
                case 'Tuesday': $pago->dia = 'Martes'; break;
                case 'Wednesday': $pago->dia = 'Miércoles'; break;
                case 'Thursday': $pago->dia = 'Jueves'; break;
                case 'Friday': $pago->dia = 'Viernes'; break;
                case 'Saturday': $pago->dia = 'Sábado'; break;
                case 'Sunday': $pago->dia = 'Domingo'; break;
            } */
        }
        $totalBanca = 0;
        foreach ($pagosBanca as $value) {
            $date = date_create($value->start);
            $fecha=date_format($date, 'Y-m-d');
            $value->start = $fecha;
            $totalBanca += $value->title;
        }
        $totalEfectivos = 0;
        foreach ($efectivos as $value1) {
            $date = date_create($value1->start);
            $fecha=date_format($date, 'Y-m-d');
            $value1->start = $fecha;
            $totalEfectivos += $value1->title;
        }

        $title = 'PREVISUALIZACION DE PAGOS';
        $pdf = PDF::loadView('layouts.pdfs.reportePagos', compact('unidad', 'fechaInicio', 'fechaFinal', 'totalPagos', 'pagosProgramados', 'pagosBanca', 'efectivos', 'title', 'totalBanca', 'totalEfectivos'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream('download.pdf');
    }
}
