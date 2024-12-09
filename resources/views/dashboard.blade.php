@extends('adminlte::page')

@section('title', 'Dashboard - SystemBarberShop')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>BIENVENIDO AL SYSTEM BARBER SHOP</h1>
        <a href="http://127.0.0.1:8000/vistareservaciones" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> Nueva Reservación
        </a>
    </div>
@stop

@section('content')
    <!-- Imagen de Fondo -->
    <div style="background-image: url('vendor/adminlte/dist/img/dashboard-bg.jpg'); background-size: cover; background-position: center; padding: 50px; border-radius: 10px;">
    
     <!-- Sección de Botones -->
     <div class="row mb-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3></h3>
                        <p>Gestionar Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/clientes" class="small-box-footer">
                        Más información <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3></h3>
                        <p>Gestionar Compras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/compras" class="small-box-footer">
                        Ver todas <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3></h3>
                        <p>Gestionar Inventarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cut"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/inventarios" class="small-box-footer">
                        Administrar <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3></h3>
                        <p>Gestionar Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="http://127.0.0.1:8000/ventas" class="small-box-footer">
                        Nueva Venta <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    
    
    
    <!-- Video de Presentación -->
            <div class="text-center my-5">
            <video autoplay loop muted style="max-width: 50%; border-radius: 10px;">
                <source src="vendor/adminlte/dist/img/BARBERSHOP2.mp4" type="video/mp4">
                Tu navegador no soporta la reproducción de video.
            </video>
        </div>    
    
         <!-- Misión, Visión y Eslogan -->
         <div class="row text-center my-4">
            <div class="col-lg-4">
                <div class="card bg-light shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-primary">Nuestra Misión</h3>
                        <p class="card-text">
                            Ser el sistema líder en la gestión de barberías, proporcionando herramientas digitales intuitivas y seguras que optimicen los procesos operativos, mejoren la experiencia del cliente y permitan a las barberías alcanzar su máximo potencial en eficiencia y servicio.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-light shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-success">Nuestra Visión</h3>
                        <p class="card-text">
                            Convertirnos en la solución tecnológica más confiable y ampliamente utilizada en el sector de barberías, promoviendo la transformación digital del negocio tradicional hacia un modelo moderno, con innovación constante y excelencia en cada detalle.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-light shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Eslogan</h3>
                        <p class="card-text fw-bold">
                            System Barber Shop:
                            <br>
                            <br>
                            "Innovación que transforma tu barbería."
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
       

<!-- Carrusel de Imágenes -->
<div id="dashboardCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="vendor/adminlte/dist/img/dashboard-bg1.jpg" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="vendor/adminlte/dist/img/dashboard-bg2.jpg" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="vendor/adminlte/dist/img/dashboard-bg3.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



    </div>
@stop

@section('footer')
    <footer class="main-footer bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <!-- Información General -->
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} <strong>System Barber Shop</strong>. Todos los derechos reservados.
                    </p>
                </div>
                <!-- Enlaces -->
                <div class="col-md-6 text-center text-md-end">
                    <a href="/politicas-de-privacidad" class="text-white mx-2">Política de Privacidad</a>
                    <a href="/terminos-y-condiciones" class="text-white mx-2">Términos y Condiciones</a>
                    <a href="/contacto" class="text-white mx-2">Contacto</a>
                </div>
            </div>
        </div>
    </footer>
@stop

@section('css')
    <style>
        .main-footer {
            background-color: #343a40; /* Fondo oscuro */
            color: white; /* Texto blanco */
        }

        .main-footer a {
            text-decoration: none; /* Sin subrayado */
        }

        .main-footer a:hover {
            text-decoration: underline; /* Subrayado al pasar el cursor */
        }

        .main-footer p {
            margin: 0; /* Sin márgenes adicionales */
        }
    </style>
@stop


@section('css')
    <link rel="stylesheet" href="/css/custom.css">
    <style>
        body {
            background-color: #eaeaea; /* Cambia el color aquí */
        }

        .carousel-item img {
            max-height: 400px; /* Ajusta la altura máxima del carrusel */
            object-fit: cover; /* Asegura que las imágenes se ajusten */
        }

        .fw-bold {
            font-weight: bold;
        }

        /* Estilos para la misión, visión y eslogan */
        .mission-vision-eslogan {
            color: white; /* Texto en blanco */
            font-family: 'San serif', serif; /* Fuente Algerian */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Sombra para mejorar visibilidad */
        }

        .text-white {
            color: white; /* Eslogan en blanco */
        }
    </style>
@stop
