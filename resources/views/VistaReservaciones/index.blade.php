@extends('adminlte::page')

@section('title', 'System Barber Shop')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero position-relative">
        <!-- Video de fondo -->
        <video autoplay muted loop playsinline class="hero-video">
            <source src="vendor/adminlte/dist/img/BARBERSHOP3.mp4" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>

        <!-- Capa semitransparente -->
        <div class="hero-overlay"></div>

        <!-- Contenido superpuesto -->
        <div class="hero-content text-center text-white">
            <h1 class="display-4">SYSTEM BARBER SHOP</h1>
            <p class="lead">Boulevard Morazán, Tegucigalpa · Honduras · +504 2234 5678</p>
            <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createModal">RESERVAR HORA</a>
        </div>
    </div>
</div>

<!-- Modal de creación de nueva reservación -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nueva Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vistareservaciones.store') }}" method="POST">
                    @csrf
                    <!-- COD_CLIENTE -->
                    <div class="form-group">
                        <label for="COD_CLIENTE">Código del Cliente</label>
                        <input type="number" class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" required>
                    </div>

                    <!-- NOMBRE_CLIENTE -->
                    <div class="form-group">
                        <label for="NOMBRE_CLIENTE">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="NOMBRE_CLIENTE" name="NOMBRE_CLIENTE" required>
                    </div>

                    <!-- NUMERO_TELEFONO -->
                    <div class="form-group">
                        <label for="NUMERO_TELEFONO">Número de Teléfono</label>
                        <input type="number" class="form-control" id="NUMERO_TELEFONO" name="NUMERO_TELEFONO" required>
                    </div>

                    <!-- EDAD_CLIENTE -->
                    <div class="form-group">
                        <label for="EDAD_CLIENTE">Edad del Cliente</label>
                        <input type="number" class="form-control" id="EDAD_CLIENTE" name="EDAD_CLIENTE" required>
                    </div>

                    <!-- EMAIL_CLIENTE -->
                    <div class="form-group">
                        <label for="EMAIL_CLIENTE">Correo Electrónico</label>
                        <input type="email" class="form-control" id="EMAIL_CLIENTE" name="EMAIL_CLIENTE" required>
                    </div>

                    <!-- FEC_RESERVACION -->
                    <div class="form-group">
                        <label for="FEC_RESERVACION">Fecha de Reservación</label>
                        <input type="date" class="form-control" id="FEC_RESERVACION" name="FEC_RESERVACION" required>
                    </div>

                    <!-- ESTADO -->
                    <div class="form-group">
                        <label for="ESTADO">Estado</label>
                        <input type="text" class="form-control" id="ESTADO" name="ESTADO" required>
                    </div>

                    <!-- NOMBRE_SERVICIO -->
                    <div class="form-group">
                        <label for="NOMBRE_SERVICIO">Nombre del Servicio</label>
                        <input type="text" class="form-control" id="NOMBRE_SERVICIO" name="NOMBRE_SERVICIO" required>
                    </div>

                    <!-- DESCRIPCION_SERVICIO -->
                    <div class="form-group">
                        <label for="DESCRIPCION_SERVICIO">Descripción del Servicio</label>
                        <textarea class="form-control" id="DESCRIPCION_SERVICIO" name="DESCRIPCION_SERVICIO" rows="3" required></textarea>
                    </div>

                    <!-- PRECIO -->
                    <div class="form-group">
                        <label for="PRECIO">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" required>
                    </div>

                    <!-- DURACION -->
                    <div class="form-group">
                        <label for="DURACION">Duración</label>
                        <input type="number" class="form-control" id="DURACION" name="DURACION" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Reservación</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* Elimina márgenes y padding globales */
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Previene el desplazamiento horizontal */
    }

    /* Asegura que el contenedor principal ocupe todo el ancho */
    .container-fluid {
        padding: 0;
    }

    /* Hero Section */
    .hero {
        position: relative;
        height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden; /* Asegura que el video no se desborde */
    }

    /* Video de fondo */
    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Asegura que el video cubra todo el fondo */
        z-index: 1;
    }

    /* Capa de superposición */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Ajusta la opacidad según sea necesario */
        z-index: 2;
    }

    /* Contenido superpuesto */
    .hero-content {
        position: relative;
        z-index: 3; /* Asegura que el contenido esté encima del video y la capa */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .hero-content p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    /* Botón */
    .btn-lg {
        background-color: #d4a373;
        border-color: #d4a373;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-lg:hover {
        background-color: #b3845c;
        border-color: #b3845c;
    }
</style>
@stop

@section('js')
<script>
    console.log('Página cargada correctamente');
</script>
@stop
