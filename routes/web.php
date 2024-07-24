<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario_controller;
use App\Http\Controllers\Favorito_controller;
use App\Http\Controllers\Genero_controller;
use App\Http\Controllers\Libro_controller;
use App\Http\Controllers\Autor_controller;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// ------------------------------------------------------------------------------------------------------------
Route::get('/favorito/{pk_libro}', [Favorito_controller::class, 'like'])->name('favorito.like');
// Categorias -------------------------------------------------------------------------------------------------

//ruta con la funcion del controlador de mostrar informacion, y el acceso de usuario en uno
Route::get('/categorias', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return app(Genero_controller::class)->mostrar();
    } else {
        return redirect()->back()->with('warning', 'Inicia sesion para acceder');
    }
})->name('categorias');

Route::get('/libro_cat/{categoria}', [Libro_controller::class, 'mostrar_por_categoria'])->name('libro_cat');

// ------------------------------------------------------------------------------------------------------------

// Favoritos --------------------------------------------------------------------------------------------------

Route::get('/favoritos', function () {
    $pk_usuario = session('pk_usuario');

    if ($pk_usuario) {
        return app('App\Http\Controllers\Favorito_controller')->mostrar($pk_usuario);
    } else {
        return redirect()->back()->with('warning', 'Inicia sesión para acceder');
    }
})->name('favoritos');

// ------------------------------------------------------------------------------------------------------------

// Usuario ----------------------------------------------------------------------------------------------------

Route::get('/login', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return redirect()->back()->with('warning', 'Ya has iniciado sesión');
    }
    return view('login');
})->name('login');

Route::get('/perfil', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        // return view('perfil');
        return redirect()->back()->with('warning', 'SECCIÓN EN DESARROLLO');
    } else {
        return redirect()->back()->with('warning', 'Inicia sesion para acceder');
    }
})->name('perfil');

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
Route::get('/usuario/{pkUsuario}/editar', [Usuario_controller::class, 'mostrarFormularioEdicion'])->name('usuario.mostrarFormularioEdicion');
Route::put('/usuario/{pkUsuario}', [Usuario_controller::class, 'actualizar'])->name('usuario.actualizar');

// ------------------------------------------------------------------------------------------------------------

// Libro ------------------------------------------------------------------------------------------------------

Route::get('/agg_libro', [Libro_controller::class, 'libro_opciones'])->name('agg_libro');
Route::post('/agregando_libro', [Libro_controller::class, 'insertar'])->name('libro.insertar');
Route::get('/', [Libro_controller::class, 'mostrar'])->name('libro.mostrar');
Route::get('/libro/leer/{pk_libro}', [Libro_controller::class, 'leer'])->name('libro.leer');
Route::get('/libro/descargar/{pk_libro}', [Libro_controller::class, 'descargar'])->name('libro.descargar');
Route::get('/libro/{pk_libro}/editar', [Libro_controller::class, 'mostrar_por_id'])->name('libro.mostrar_por_id');
Route::put('/libro/{pk_libro}/actualizando', [Libro_controller::class, 'actualizar'])->name('libro.actualizar');
Route::match(['get', 'put'], '/libro/{pk_libro}', [Libro_controller::class, 'baja'])->name('libro.baja');

// ------------------------------------------------------------------------------------------------------------

// Admin ------------------------------------------------------------------------------------------------------

Route::get('/admin', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return view('panel_admin');
    } else {
        return redirect()->back()->with('warning', 'No puedes acceder');
    }
})->name('admin');

// ------------------------------------------------------------------------------------------------------------

// Generos ----------------------------------------------------------------------------------------------------

Route::get('/form_generos', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return view('form_generos');
    } else {
        return redirect()->back()->with('warning', 'No puedes acceder');
    }
})->name('form_generos');

Route::get('/tabla_generos', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return view('tabla_generos');
    } else {
        return redirect()->back()->with('warning', 'No puedes acceder');
    }
})->name('tabla_generos');

Route::get('/MostrarGenero', [Genero_controller::class, 'mostrarGenero'])->name('genero.mostrar');
Route::post('/InsertarGenero', [Genero_controller::class, 'insertar'])->name('genero.insertar');
Route::get('/genero/{pkGenero}/editar', [Genero_controller::class, 'mostrarFormularioEdicion'])->name('genero.mostrarFormularioEdicion');
Route::put('/genero/{pkGenero}', [Genero_controller::class, 'actualizar'])->name('genero.actualizar');
Route::match(['get', 'put'], '/genero/{pk_genero}', [Genero_controller::class, 'baja'])->name('genero.baja');
// Route::delete('/genero/{pkGenero}', [Genero_controller::class, 'eliminar'])->name('genero.eliminar');

// ------------------------------------------------------------------------------------------------------------

// Autor ------------------------------------------------------------------------------------------------------

Route::get('/form_autor', function () {
    $PK_USUARIO = session('pk_usuario');
    if ($PK_USUARIO) {
        return view('form_autor');
    } else {
        return redirect()->back()->with('warning', 'No puedes acceder');
    }
})->name('form_autor');

Route::get('/tabla_autor', [Autor_controller::class, 'mostrarAutor'])->name('autor.mostrar');

Route::post('/Insertarautor', [Autor_controller::class, 'insertar'])->name('autor.insertar');
Route::get('/autor/{pkAutor}/editar', [Autor_controller::class, 'mostrarFormularioEdicion'])->name('autor.mostrarFormularioEdicion');
Route::put('/autor/{pkAutor}', [Autor_controller::class, 'actualizar'])->name('autor.actualizar');
Route::match(['get', 'put'], '/autor/{pk_autor}', [Autor_controller::class, 'baja'])->name('autor.baja');
// Route::delete('/autor/{pkAutor}', [Autor_controller::class, 'eliminar'])->name('autor.eliminar');

// ------------------------------------------------------------------------------------------------------------

