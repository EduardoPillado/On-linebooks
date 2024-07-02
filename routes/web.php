<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario_controller;
use App\Http\Controllers\Libro_controller;
use App\Http\Controllers\Autor_controller;
use App\Http\Controllers\Genero_controller;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Perfil ----------------------------------------------------------------------------------------------------

Route::get('/perfil', function () {
    // $PK_USUARIO = session('pk_usuario');
    // if (!$PK_USUARIO) {
    //     return redirect()->back()->with('warning', 'Inicia sesión para acceder');
    // }
    return view('perfil');
})->name('perfil');

// ------------------------------------------------------------------------------------------------------------

// Usuario ----------------------------------------------------------------------------------------------------
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

// ------------------------------------------------------------------------------------------------------------

// Libro ------------------------------------------------------------------------------------------------------

Route::get('/libro', function () {
    return view('info_libro');
})->name('libro');

Route::get('/agg_libro', [Libro_controller::class, 'libro_opciones'])->name('agg_libro');
Route::post('/agregando_libro', [Libro_controller::class, 'insertar'])->name('libro.insertar');
Route::get('/', [Libro_controller::class, 'mostrar'])->name('libro.mostrar');

// ------------------------------------------------------------------------------------------------------------

// Admin ------------------------------------------------------------------------------------------------------

Route::get('/admin', function () {
    return view('panel_admin');
})->name('admin');

// Generos

Route::get('/form_generos', function () {
    $PK_USUARIO = session('pk_usuario');
    // if ($PK_USUARIO) {
    //     return redirect()->back()->with('warning', 'No eres admin bro');
    // }
    return view('form_generos');
})->name('form_generos');

Route::get('/tabla_generos', function () {
    return view('tabla_generos');
})->name('tabla_generos');

// Ruta para mostrar los géneros
Route::get('/MostrarGenero', [Genero_controller::class, 'mostrarGenero'])->name('genero.mostrar');

// Guardar formulario de creación
Route::post('/InsertarGenero', [Genero_controller::class, 'insertar'])->name('genero.insertar');
// Mostrar formulario de edición
Route::get('/genero/{pkGenero}/editar', [Genero_controller::class, 'mostrarFormularioEdicion'])->name('genero.mostrarFormularioEdicion');
// Actualizar
Route::put('/genero/{pkGenero}', [Genero_controller::class, 'actualizar'])->name('genero.actualizar');
// Eliminar registro
Route::delete('/genero/{pkGenero}', [Genero_controller::class, 'eliminar'])->name('genero.eliminar');


// Autor
Route::get('/form_autor', function () {
    // $PK_USUARIO = session('pk_usuario');
    // if (!$PK_USUARIO) {
    //     return redirect()->back()->with('warning', 'No eres admin bro');
    // }
    return view('form_autor');
})->name('form_autor');

Route::get('/tabla_autor', [Autor_controller::class, 'mostrarAutor'])->name('autor.mostrar');

// Guardar formulario de creación
Route::post('/Insertarautor', [Autor_controller::class, 'insertar'])->name('autor.insertar');
// Mostrar formulario de edición
Route::get('/autor/{pkAutor}/editar', [Autor_controller::class, 'mostrarFormularioEdicion'])->name('autor.mostrarFormularioEdicion');
// Actualizar
Route::put('/autor/{pkAutor}', [Autor_controller::class, 'actualizar'])->name('autor.actualizar');
// Eliminar registro
Route::delete('/autor/{pkAutor}', [Autor_controller::class, 'eliminar'])->name('autor.eliminar');

// ------------------------------------------------------------------------------------------------------------