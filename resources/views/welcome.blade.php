<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SystemBarberShop</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos para el video de fondo */
        video.background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>
<body class="hold-transition login-page" style="background-color: #f4f6f9;">
    <!-- Video de fondo -->
    <video class="background-video" autoplay loop muted>
        <source src="vendor/adminlte/dist/img/BARBERSHOP.mp4" type="video/mp4">
        Tu navegador no soporta el video.
    </video>

    <div class="login-box">
        <!-- Logo -->
        <div class="login-logo">
            <img src="vendor/adminlte/dist/img/LOGO.png" alt="SystemBarberShop Logo" style="width: 150px; height: auto; margin-bottom: 20px;">
            <a href="#" class="text-indigo-600">
                
            </a>
        </div>
        <!-- Login Card -->
        <div class="card">
            <div class="card-body login-card-body">
            <h3 class="text-center text-bold mb-3">SystemBarberShop</h3>
                <h3 class="text-center text-bold mb-3">Bienvenido</h3>
                <p class="login-box-msg">La mejor solución para gestionar tu barbería.</p>
                <div class="d-grid gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
