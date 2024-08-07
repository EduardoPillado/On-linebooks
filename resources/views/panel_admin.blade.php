<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/On-linebooks.ico') }}" rel="icon">
    <title>On-linebooks | Panel administrador</title>
</head>
<body>

    @include('sidebar')

<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .card {
        width: 345px;
        height: fit-content;
        background: rgb(255, 255, 255);
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 20px;
        padding: 30px;
        position: relative;
        margin: 10px;
        box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.068);
    }
    .card-content {
        width: 100%;
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .card-heading {
        font-size: 20px;
        font-weight: 700;
        color: rgb(27, 27, 27);
    }
    .card-description {
        font-weight: 100;
        color: rgb(102, 102, 102);
    }
    .card-button-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .card-button {
        width: 50%;
        height: 35px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: inherit;
    }
    .primary {
        background-color: rgb(255, 114, 109);
        color: white;
    }
    .primary:hover {
        background-color: rgb(255, 73, 66);
    }
    .secondary {
        background-color: #ddd;
    }
    .secondary:hover {
        background-color: rgb(197, 197, 197);
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-content">
            <p class="card-heading">Géneros</p>
            <p class="card-description">Gestiona y agrega géneros literarios</p>
        </div>
        <div class="card-button-wrapper">
            <a href="{{ route('genero.mostrar') }}" class="card-button secondary">Panel</a>
            <a href="{{ route('form_generos') }}" class="card-button primary">Registrar</a>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <p class="card-heading">Autores</p>
            <p class="card-description">Gestiona y agrega autores de libros</p>
        </div>
        <div class="card-button-wrapper">
            <a href="{{ route('autor.mostrar') }}" class="card-button secondary">Panel</a>
            <a href="{{ route('form_autor') }}" class="card-button primary">Registrar</a>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <p class="card-heading">Libros</p>
            <p class="card-description">Gestiona y agrega libros en On-linebooks</p>
        </div>
        <div class="card-button-wrapper">
            <a href="{{ url('/') }}" class="card-button secondary">Panel</a>
            <a href="{{ route('agg_libro') }}" class="card-button primary">Registrar</a>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <p class="card-heading">Usuarios</p>
            <p class="card-description">Gestiona y agrega usuarios admin de On-linebooks</p>
        </div>
        <div class="card-button-wrapper">
            <a href="{{ route('usuario.mostrar') }}" class="card-button secondary">Panel</a>
            <a href="{{ route('registro_admin') }}" class="card-button primary">Registrar admin</a>
        </div>
    </div>
</div>

@include('fooder')
    
</body>
</html>