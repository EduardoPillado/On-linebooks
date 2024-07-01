<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
@include('sidebar')

<h1>Categorías</h1>

<div class="contenedor">
<!-- muestra div por registro de categoria -->
@foreach ($datos_genero as $dato)
  <div class="card">
    <a class="link-sin-subrayado" href="{{ route('libro_cat', $dato->nombre_genero) }}">
        <h2>{{ $dato->nombre_genero }}</h2>
        <span class="explore-text">Explorar</span>
    </a>
  </div>
@endforeach
</div>

<style type="text/css">
  body {
            overflow-y: scroll; 
            overflow-x: hidden; 
            height: 100vh;
        }
  .contenedor {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centra los elementos horizontalmente */
    padding: 20px; /* Espacio interno del contenedor */
    max-width: 1000px; /* Ancho máximo del contenedor */
    margin: 0 auto; /* Centra el contenedor horizontalmente */
}
    .card {
  position: relative;
  width: 300px;
  height: 300px;
  background: #4C8CE4;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 25px;
  font-weight: bold;
  border-radius: 15px;
  cursor: pointer;
  padding: 10px;
  margin: 10px; /* Espacio entre elementos */
  text-align: center;
  overflow: hidden;
}

.card::before,
.card::after {
  position: absolute;
  content: "";
  width: 20%;
  height: 20%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 25px;
  font-weight: bold;
  background-color: #86AEE5;
  transition: all 0.5s;
}

.card::before {
  top: 0;
  right: 0;
  border-radius: 0 15px 0 100%;
}

.card::after {
  bottom: 0;
  left: 0;
  border-radius: 0 100%  0 15px;
}

.card:hover::before,
.card:hover:after {
  width: 100%;
  height: 100%;
  border-radius: 15px;
  transition: all 0.5s;
}

.card:hover:after {
  content: "Explorar";
}


.card a {
    display: block; /* Hace que el enlace ocupe todo el espacio del div */
    position: relative; /* Asegura que los pseudo-elementos se posicionen correctamente */
    z-index: 1; /* Asegura que el enlace esté sobre el pseudo-elemento */
}

.card:hover a {
    color: transparent; /* Oculta el texto y cualquier otro contenido del enlace */
}

.explore-text {
    display: none; /* Oculta el texto "Explorar" inicialmente */
    position: absolute; /* Posición absoluta para que se superponga */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
    z-index: 2; /* Asegura que esté sobre el enlace */
}
.link-sin-subrayado {
        text-decoration: none; /* Quita el subrayado */
        color: black; /* Cambia el color del texto */
    }
</style>

@include('fooder')
</body>
</html>