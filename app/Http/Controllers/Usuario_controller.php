<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Usuario_controller extends Controller
{
    use ValidatesRequests;
    
    public function login(Request $req){
        $this->validate($req, [
            'nombre_usuario' => 'required',
            'contraseña' => 'required',
        ]);
    
        $credentials = $req->only('nombre_usuario', 'contraseña');

        $usuario = $this->obtenerUsuarioPorNombre($credentials['nombre_usuario']);

        if ($usuario && password_verify($credentials['contraseña'], $usuario->contraseña)) {
            if ($usuario->estatus_usuario == 1) {
                session(['pk_usuario' => $usuario->pk_usuario, 'nombre_usuario' => $usuario->nombre_usuario]);
                return redirect('/')->with('success', 'Bienvenido');
            } else {
                return redirect('/login')->with('error', 'Usuario no válido');
            }
        } else {
            return redirect('/login')->with('error', 'Datos incorrectos');
        }
        
    }

    private function obtenerUsuarioPorNombre($nombre_usuario){
        $usuario = Usuario::where('nombre_usuario', $nombre_usuario)->first();
        return $usuario;
    }

    public function logout() {
        session()->forget(['pk_usuario', 'nombre_usuario']);
        return redirect('/login')->with('success', 'Sesión cerrada');
    }
}
