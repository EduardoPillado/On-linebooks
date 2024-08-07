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
                session([
                    'pk_usuario' => $usuario->pk_usuario, 
                    'nombre_usuario' => $usuario->nombre_usuario,
                    'correo_usuario' => $usuario->correo,  // Cambiar 'correo' a 'correo_usuario'
                ]);
                session([
                    'pk_tipo_usuario' => $usuario->tipo_usuario->pk_tipo_usuario, 
                    'nombre_tipo_usuario' => $usuario->tipo_usuario->nombre_tipo_usuario
                ]);
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
        session()->forget(['pk_usuario', 'nombre_usuario', 'correo_usuario', 'pk_tipo_usuario', 'nombre_tipo_usuario']);
        return redirect('/login')->with('success', 'Sesión cerrada');
    }

    public function insertar(Request $req){
        $req->validate([
            'nombre_usuario' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:usuario,nombre_usuario'],
            'correo' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'email', 'max:255', 'unique:usuario,correo'],
            'contraseña' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'min:8', 'max:255'],
        ], [
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.regex' => 'El nombre de usuario solo puede contener letras, números y espacios.',
            'nombre_usuario.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.',
    
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.regex' => 'El correo electrónico no tiene un formato válido.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'correo.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'correo.unique' => 'El correo electrónico ya está en uso.',
    
            'contraseña.required' => 'La contraseña es obligatoria.',
            'contraseña.regex' => 'La contraseña solo puede contener letras, números y espacios.',
            'contraseña.min' => 'La contraseña debe tener al menos :min caracteres.',
            'contraseña.max' => 'La contraseña no puede tener más de :max caracteres.',
        ]);

        $usuario=new Usuario();
        
        $usuario->nombre_usuario=$req->nombre_usuario;
        $usuario->correo=$req->correo;
        $pass = $req->input('contraseña');
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        $usuario->contraseña=$hash;
        $usuario->fk_tipo_usuario=2;
        $usuario->token = md5($usuario->correo);
        $usuario->estatus_usuario=1;

        $usuario->save();
        
        if ($usuario->pk_usuario) {
            return redirect('/login')->with('success', 'Registro exitoso');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    public function insertar_admin(Request $req){
        $req->validate([
            'nombre_usuario' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:usuario,nombre_usuario'],
            'correo' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'email', 'max:255', 'unique:usuario,correo'],
            'contraseña' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'min:8', 'max:255'],
        ], [
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.regex' => 'El nombre de usuario solo puede contener letras, números y espacios.',
            'nombre_usuario.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.',
    
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.regex' => 'El correo electrónico no tiene un formato válido.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'correo.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'correo.unique' => 'El correo electrónico ya está en uso.',
    
            'contraseña.required' => 'La contraseña es obligatoria.',
            'contraseña.regex' => 'La contraseña solo puede contener letras, números y espacios.',
            'contraseña.min' => 'La contraseña debe tener al menos :min caracteres.',
            'contraseña.max' => 'La contraseña no puede tener más de :max caracteres.',
        ]);

        $usuario=new Usuario();
        
        $usuario->nombre_usuario=$req->nombre_usuario;
        $usuario->correo=$req->correo;
        $pass = $req->input('contraseña');
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        $usuario->contraseña=$hash;
        $usuario->fk_tipo_usuario=1;
        $usuario->token = md5($usuario->correo);
        $usuario->estatus_usuario=1;

        $usuario->save();
        
        if ($usuario->pk_usuario) {
            return redirect('/admin')->with('success', 'Administrador registrado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    public function mostrarUsuario()
    {
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $datos_usuario = Usuario::where('estatus_usuario', '=', 1)->get();
                return view('tabla_usuario', compact('datos_usuario'));
            } else {
                return redirect()->back()->with('warning', 'No puedes acceder');
            }
        } else {
            return redirect()->back()->with('warning', 'No puedes acceder');
        }
    }

    public function mostrarFormularioEdicion($pkUsuario)
{
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $datosUsuario = Usuario::findOrFail($pkUsuario);
            return view('editar_usuario', compact('datosUsuario'));
        } else {
            return redirect()->back()->with('warning', 'No puedes acceder');
        }
}


    public function actualizar(Request $req, $pkUsuario)
    {
        $datosUsuario = Usuario::findOrFail($pkUsuario);

        $req->validate([
            'nombre_usuario' => ['required', 'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/', 'max:255', 'unique:usuario,nombre_usuario'],
            'correo' => ['required', 'email', 'max:255', 'unique:usuario,correo,' . $pkUsuario . ',pk_usuario']
        ], [
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.regex' => 'El nombre de usuario solo puede contener letras, números y espacios.',
            'nombre_usuario.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.',
            
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'correo.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'correo.unique' => 'El correo electrónico ya está en uso.'
        ]);

        $datosUsuario->nombre_usuario = $req->nombre_usuario;
        $datosUsuario->correo = $req->correo;
        $datosUsuario->save();

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function baja($pk_usuario){
        $PK_USUARIO = session('pk_usuario');
        if ($PK_USUARIO) {
            $tipo_usuario = session('nombre_tipo_usuario');
            if ($tipo_usuario == 'Administrador') {
                $dato = Usuario::findOrFail($pk_usuario);

                if ($dato) {
                    $dato->estatus_usuario = 0;
                    $dato->save();

                    return back()->with('success', 'Usuario dado de baja');
                } else {
                    return back()->with('error', 'Hay algún problema con la información');
                }
            } else {
                return redirect('/')->with('warning', 'No puedes acceder');
            }
        } else {
            return redirect('/login');
        }
    }

    public function mostrarUsuariosDadosDeBaja()
{
    $datos_usuario = Usuario::where('estatus_usuario', '=', 0)->get();
    return view('tabla_usuario_baja', compact('datos_usuario'));
}




    public function darDeAlta($pk_usuario)
{
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        $tipo_usuario = session('nombre_tipo_usuario');
        if ($tipo_usuario == 'Administrador') {
            $usuario = Usuario::findOrFail($pk_usuario);

            if ($usuario) {
                $usuario->estatus_usuario = 1; // Cambia el estatus a 1 para dar de alta
                $usuario->save();

                return back()->with('success', 'Autor restaurado con éxito.');
            } else {
                return back()->with('error', 'Autor no encontrado.');
            }
        } else {
            return redirect('/')->with('warning', 'No tienes permisos para realizar esta acción.');
        }
    } else {
        return redirect('/login');
    }
}



}

?>
