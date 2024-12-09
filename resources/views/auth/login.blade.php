<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SystemBarberShop</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset("vendor/adminlte/dist/img/fondo1.jpg") }}');
            background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* La imagen permanece fija al hacer scroll */
            color: #fff; /* Ajusta el color del texto para mejor visibilidad */
        }

        .login-card-body {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con opacidad */
            border-radius: 10px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
        }

        .btn-primary {
            background-color: #007bff; /* Color principal */
            border-color: #007bff; /* Bordes del botón */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Color al pasar el cursor */
            border-color: #004085; /* Bordes al pasar el cursor */
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- Logo -->
        <div class="login-logo">
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO.png') }}" alt="SystemBarberShop Logo" style="width: 150px; height: auto; margin-bottom: 20px;">
            <a href="#" class="text-indigo-600">
                
            </a>
        </div>
        <!-- Login Card -->
        <div class="card">
            <div class="card-body login-card-body">
            <h3 class="text-center text-bold mb-3">SystemBarberShop</h3>
                <h3 class="text-center text-bold mb-3">Iniciar Sesión</h3>
                <p class="login-box-msg">Introduce tus credenciales para acceder al sistema.</p>
                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Recuérdame
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Acceder</button>
                        </div>
                    </div>
                </form>
                <!-- Links -->
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Registrarme</a>
                </p>
            </div>
        </div>
    </div>

    <!-- AdminLTE JS -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
