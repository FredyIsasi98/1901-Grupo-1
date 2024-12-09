<?php

use Illuminate\Support\Facades\Route;

// Ruta principal para la vista de ventas
Route::get('/ventas', function () {
    return view('ventas.index'); // Carga la vista en resources/views/ventas/index.blade.php
});

// Ruta para detalles de ventas
Route::get('/ventas-detalles', function () {
    return view('ventas.detalles'); // Carga la vista en resources/views/ventas/detalles.blade.php
});

Route::get('/test-web', function () {
    return 'Rutas web cargadas correctamente';
});
