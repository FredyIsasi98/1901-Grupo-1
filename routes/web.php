<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservacionesController;
use App\Http\Controllers\VistaReservacionesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\VentasDetallesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DetallesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\ReportesComprasController;

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::resource('reservaciones', ReservacionesController::class);
Route::resource('vistareservaciones', VistaReservacionesController::class);
Route::resource('ventas', VentasController::class);
Route::resource('ventasdetalles', VentasDetallesController::class);
Route::resource('compras', ComprasController::class);
Route::resource('detalles', DetallesController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('inventarios', InventariosController::class);
Route::resource('reportescompras', ReportesComprasController::class);






