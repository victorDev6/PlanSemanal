<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller {
    public function index() {

        return view('layouts.changePassword');
    }

    public function store(Request $request) {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

        $id = Auth::user()->id;
        User::where('id', '=', $id)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return redirect()->route('password.inicio')->with('success', 'La contraseña se cambio exitosamente');
    }
}
