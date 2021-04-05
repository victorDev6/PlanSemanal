<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $organos = DB::table('organos')->get();
        return view('layouts.registro', compact('organos'));
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

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organo' => ['required'],
            'telefono' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $organo = DB::table('organos')->where('id', '=', $request->organo)->get();
        $id_parent = $organo[0]->id_parent;
        if ($id_parent == 0) {
            $id_parent = null;
        }

        switch ($request->rol) {
            case 0:
                $rol = 'Areas';
                break;
            case 1:
                $rol = 'Directores';
                break;
            case 2:
                $rol = 'Validadores';
                break;
            case 3:
                $rol = 'Direccion';
                break;
        }

        User::create([
            'name' => $request->name,
            'id_organo' => $id_parent,
            'id_area' => $request->organo,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole($rol);

        return redirect()->route('registro.inicio')->with('success', 'Usuario Agregado Exitosamente');
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
    public function update(Request $request, $id)
    {
        //
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
