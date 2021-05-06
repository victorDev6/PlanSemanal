<?php

namespace App\Http\Controllers\pagos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Pagos;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagosController extends Controller {
    
    public function index() {
        $unidades = DB::table('unidades')->get();
        return view('layouts.pagos.PagosRealizados', compact('unidades'));
    }

    public function show($id, $fechaInicio, $fechaFinal) {
        if ($id != null) {
            session(['id' => $id]);
            session(['fechaInicio' => $fechaInicio]);
            session(['fechaFinal' => $fechaFinal]);
        }

        $data['pagos'] = Pagos::where('id_unidad', '=', $id)->where('fecha_enviado', '!=', null)->whereBetween('start', [$fechaInicio, $fechaFinal])->get();
        return response()->json($data['pagos']);
    }

    public function reporte() {
        if (session('id') != 'undefined') {
            $id = session('id');
            $fechaInicio = session('fechaInicio');
            $fechaFinal = session('fechaFinal');

            $unidad = DB::table('unidades')->where('id', '=', $id)->get();
            $pagos = Pagos::where('id_unidad', '=', $id)->where('fecha_enviado', '!=', null)
                    ->whereBetween('start', [$fechaInicio, $fechaFinal])
                    ->orderBy('start', 'ASC')->get();

            $totalPagos = 0;
            foreach ($pagos as $pago) {
                $date = date_create($pago->start);
                $fecha=date_format($date, 'Y-m-d');
                $pago->start = $fecha;
                $totalPagos += $pago->title;
                $day = Carbon::parse($pago->start)->format('l');
                switch ($day) {
                    case 'Monday':
                        $pago->dia = 'Lunes';
                        break;
                    case 'Tuesday':
                        $pago->dia = 'Martes';
                        break;
                    case 'Wednesday':
                        $pago->dia = 'Miércoles';
                        break;
                    case 'Thursday':
                        $pago->dia = 'Jueves';
                        break;
                    case 'Friday':
                        $pago->dia = 'Viernes';
                        break;
                    case 'Saturday':
                        $pago->dia = 'Sábado';
                        break;
                    case 'Sunday':
                        $pago->dia = 'Domingo';
                        break;
                }
            }

            $pdf = PDF::loadView('layouts.pdfs.reportePagos', compact('unidad', 'fechaInicio', 'fechaFinal', 'totalPagos', 'pagos'));
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('download.pdf');
        } else {
            return redirect()->route('pagosRealizados.inicio')->with('success', 'Debe realizar una busqueda antes de generar un reporte!');
        }

        
    }
}
