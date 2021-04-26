<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller {
    
    public function index() {
        $users = DB::table('users')->where('users.id', '!=', 1)->leftJoin('organos', 'users.id_area', '=', 'organos.id')
            ->leftJoin('organos as org', 'users.id_organo', '=', 'org.id')
            ->select('users.*', 'organos.descripcion', 'org.descripcion as descripcion2')->get();
        $roles = DB::table('roles')->where('id', '!=', 5)->get();
        $permisos = DB::table('model_has_roles')->get();

        return view('layouts.inicioUsuarios', compact('users', 'roles', 'permisos'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        DB::table('model_has_roles')->where('model_id', '=', $request->id)->delete();
        if ($request->permisos != null) {
            foreach ($request->permisos as $value) {
                DB::table('model_has_roles')->insert([
                    'role_id' => $value,
                    'model_type' => 'App\User',
                    'model_id' => $request->id,
                ]);
            }
        }

        return redirect()->route('usuarios.inicio')->with('success', 'SE GUARDARON LOS CAMBIOS CORRECTAMENTE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
