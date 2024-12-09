<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SystemBarberShop</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
            border-radius: 10px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
        }

        .login-logo img {
            margin-bottom: 15px;
            border-radius: 10px; /* Redondeo de bordes */
        }

        h1 {
            color: #fff;
            font-weight: 700;
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
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO.png') }}" alt="SystemBarberShop Logo" class="img-circle elevation-3" style="width: 120px;">
            <h1><b>System</b>BarberShop</h1>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Regístrate para empezar</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Correo Electrónico -->
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Contraseña -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Confirmar Contraseña -->
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Botón de Registro -->
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                        </div>
                    </div>
                </form>

                <!-- Link de Inicio de Sesión -->
                <p class="mt-3 mb-1 text-center">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </p>
            </div>
        </div>
    </div>

    <!-- AdminLTE Scripts -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
