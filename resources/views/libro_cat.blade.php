@include('sidebar')

<h1>Categoría</h1>
<div class="contenedor">

@foreach ($datos_libro as $dato)
<div class="book">
    <ul>
            <li>Descripción: {{ $dato->descripcion }}</li>
            <li>Año de publicación: {{ $dato->año_publicacion }}</li>
    </ul>

    @foreach ($datos_libro as $dato)
    <div class="cover">
            <h2>{{ $dato->titulo }}</h2>
    </div>
    @endforeach

</div>
@endforeach
</div>

<style type="text/css"> 
.contenedor {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centra los elementos horizontalmente */
    padding: 20px; /* Espacio interno del contenedor */
    max-width: 1000px; /* Ancho máximo del contenedor */
    margin: 0 auto; /* Centra el contenedor horizontalmente */
}

.book {
  position: relative;
  border-radius: 10px;
  width: 220px;
  height: 300px;
  margin: 10px; /* Espacio entre elementos */
  background-color: whitesmoke;
  -webkit-box-shadow: 1px 1px 12px lightgrey;
  box-shadow: 1px 1px 12px lightgray;
  -webkit-transform: preserve-3d;
  -ms-transform: preserve-3d;
  transform: preserve-3d;
  -webkit-perspective: 2000px;
  perspective: 2000px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  color: #000;
}

.cover {
  top: 0;
  position: absolute;
  background-color: #4074EF;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  cursor: pointer;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  -webkit-transform-origin: 0;
  -ms-transform-origin: 0;
  transform-origin: 0;
  -webkit-box-shadow: 1px 1px 12px lightgray;
  box-shadow: 1px 1px 12px lightgray;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
}

.book:hover .cover {
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  -webkit-transform: rotatey(-80deg);
  -ms-transform: rotatey(-80deg);
  transform: rotatey(-80deg);
}

p {
  font-size: 20px;
  font-weight: bolder;
}

.book p, .book ul {
    margin: 0; /* Elimina márgenes predeterminados */
    padding: 0; /* Elimina relleno predeterminado */
    font-size: 12px; /* Tamaño de fuente más pequeño */
}

.book ul {
    list-style-type: none; /* Elimina viñetas de la lista */
}

.book li {
    text-align: center;
    margin: 5px 0; /* Espaciado entre párrafos */
    font-size: 12px; /* Tamaño de fuente */
    max-width: 160px; /* Ancho máximo para evitar desbordamiento */
    /* white-space: wrap;  Acorta el texto si se sale del espacio predeterminado*/
    overflow: hidden; /* Oculta texto que sobrepasa el ancho */
    text-overflow: ellipsis; /* Agrega puntos suspensivos si el texto es demasiado largo */
}
</style>

@include('fooder')