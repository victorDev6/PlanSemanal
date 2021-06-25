<?php

namespace App\Http\Controllers\pagos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pagos;
use Carbon\Carbon;
use PDF;

class CronogramaPagosController extends Controller {
    
    public function index(Request $request) {
        $unidades = DB::table('unidades')->get();
        foreach ($unidades as $value) {
            $value->nombre = ucfirst(mb_substr($value->nombre, 23, null, 'UTF-8'));
        }

        $fechaInicio = $request->fecha_inicio;
        $fechaTermino = $request->fecha_termino;
        if ($fechaInicio != null) {
            session(['fechaInicio' => $fechaInicio]);
            session(['fechaTermino' => $fechaTermino]);
        }

        $pagos = Pagos::where('fecha_enviado', '!=', null)
                    ->whereBetween('start', [$fechaInicio, $fechaTermino])
                    ->orderBy('start', 'ASC')
                    ->get();
        foreach ($pagos as $value) {
            $value->fecha_registro = Carbon::parse($value->fecha_registro)->format('Y/m/d');
        }

        $grouped = $pagos->groupBy('start');
        $grouped->toArray();

        foreach ($pagos as $pago) {
            $date = date_create($pago->start);
            $fecha = date_format($date, 'Y-m-d');
            $pago->start = $fecha;
        }

        return view('layouts.pagos.cronogramaPagos', compact('unidades', 'fechaInicio', 'fechaTermino', 'pagos', 'grouped'));
    }

    public function reporte() {
        if (session('fechaInicio') != 'undefined') {
            $fechaInicio = session('fechaInicio');
            $fechaTermino = session('fechaTermino');

            $unidades = DB::table('unidades')->get();
            foreach ($unidades as $value) {
                $value->nombre = ucfirst(mb_substr($value->nombre, 23, null, 'UTF-8'));
            }

            $pagos = Pagos::where('fecha_enviado', '!=', null)
                        ->whereBetween('start', [$fechaInicio, $fechaTermino])
                        ->orderBy('start', 'ASC')
                        ->get();
            foreach ($pagos as $value) {
                $value->fecha_registro = Carbon::parse($value->fecha_registro)->format('Y/m/d');
            }

            $grouped = $pagos->groupBy('start');
            $grouped->toArray();

            foreach ($pagos as $pago) {
                $date = date_create($pago->start);
                $fecha = date_format($date, 'Y-m-d');
                $pago->start = $fecha;
            }

            $pdf = PDF::loadView('layouts.pdfs.reporteCronograma', compact('unidades', 'fechaInicio', 'fechaTermino', 'pagos', 'grouped'));
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream('download.pdf');
        } else {
            return redirect()->route('cronogramaPagos.inicio')->with('success', 'Debe realizar una busqueda antes de generar un reporte!');
        }
    }
}
