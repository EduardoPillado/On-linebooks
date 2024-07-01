<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario_controller; // Asegúrate de usar PascalCase para los nombres de las clases
use App\Http\Controllers\Genero_controller;  // Asegúrate de usar PascalCase para los nombres de las clases
use App\Http\Controllers\Autor_controller;  // Asegúrate de usar PascalCase para los nombres de las clases

Route::get('/', function () {
    return view('inicio');
});

// Perfil
Route::get('/perfil', function () {
    $PK_USUARIO = session('pk_usuario');
    if (!$PK_USUARIO) {
        return redirect()->back()->with('warning', 'Inicia sesión para acceder');
    }
    return view('perfil');
})->name('perfil');

// Usuario
Route::get('/login', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Ya has iniciado sesión');
    }
    return view('login');
})->name('login');

Route::get('/registro', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Cierra sesión para acceder');
    }
    return view('registro');
})->name('registro');

Route::post('/iniciandoSesión', [Usuario_controller::class, 'login'])->name('usuario.login');
Route::get('/cerrandoSesión', [Usuario_controller::class, 'logout'])->name('usuario.logout');
Route::post('/registrando', [Usuario_controller::class, 'insertar'])->name('usuario.insertar');

// Admin
Route::get('/admin', function () {
    return view('panel_admin');
})->name('admin');

// Generos
Route::get('/form_generos', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'No eres admin bro');
    }
    return view('form_generos');
})->name('form_generos');

Route::get('/tabla_generos', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'No eres admin bro');
    }
    return view('tabla_generos');
})->name('tabla_generos');

// Route::get('/tablageneros', [Genero_controller::class, 'mostrarGeneros'])->name('mostrar');


Route::post('/Insertargenero', [Genero_controller::class, 'insertar'])->name('genero.insertar');
Route::get('/generos', [Genero_controller::class, 'mostrarGeneros'])->name('generos.mostrar'); // Descomenta esta línea para que funcione la ruta


//Autor
Route::get('/form_autor', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'No eres admin bro');
    }
    return view('form_autor');
})->name('form_autor');

Route::get('/tabla_autor', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'No eres admin bro');
    }
    return view('tabla_autor');
})->name('tabla_autor');

Route::post('/Insertarautor', [Autor_controller::class, 'insertar'])->name('autor.insertar');
Route::get('/MostrarAutor', [Autor_controller::class, 'mostrarAutor'])->name('autor.mostrar'); // Descomenta esta línea para que funcione la ruta
Route::put('/autor/{pkAutor}/update', [Autor_Controller::class, 'actualizar'])->name('autor.actualizar');

// Libro
Route::get('/form_libro', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'No eres admin bro');
    }
    return view('form_libro');
})->name('form_libro');
?>
 
  