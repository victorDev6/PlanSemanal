<?php

namespace App\Http\Controllers\pagos;

use App\Http\Controllers\Controller;
use App\Pagos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddPagoController extends Controller {

    public function index() {
        $unidades = DB::table('unidades')->get();
        return view('layouts.pagos.agregarPago', compact('unidades'));
    }

    public function store(Request $request) {
        $datosEvento = request()->except(['_token', '_method']);
        Pagos::insert($datosEvento);
    }

    public function show($id) {
        $data['pagos'] = Pagos::where('id_unidad', '=', $id)->get();
        return response()->json($data['pagos']);
    }

    public function update(Request $request, $id) {
        $respuesta = Pagos::where('id', '=', $id)->update([
            'title' => $request->title,
            'comentarios' => $request->comentarios
        ]);
        return response()->json($respuesta);
    }

    public function destroy($id) {
        Pagos::destroy($id);
        return response()->json($id);
    }

    public function sendPagos(Request $request) {
        $date = date('Y-m-d H:i:s');
        Pagos::where('id_unidad', '=', $request->id_unidad)
            ->where('fecha_enviado', '=', null)->update([
                'fecha_enviado' => $date
            ]);
        return 'success';
    }
}
