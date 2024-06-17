<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario_controller;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/login', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Ya has iniciado sesión');
    } else {
        return view('login');
    }
})->name('login');

Route::get('/perfil', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Inicia sesion para acceder');
    } else {
        return view('perfil');
    }
})->name('perfil');

// Usuario ----------------------------------------------------------------------------------------------------

Route::get('/registro', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Cierra sesión para acceder');
    } else {
        return view('registro');
    }
})->name('registro');

Route::post('/iniciandoSesión', [Usuario_controller::class, 'login'])->name('usuario.login');
Route::get('/cerrandoSesión', [Usuario_controller::class, 'logout'])->name('usuario.logout');

Route::post('/registrando', [Usuario_controller::class, 'insertar'])->name('usuario.insertar');

// ------------------------------------------------------------------------------------------------------------
