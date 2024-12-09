<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API
        $response = Http::get('http://localhost:3000/reservaciones/seleccionar');
    
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $reservaciones = $response->json();
        } else {
            // Si la API falla, definir $reservaciones como un array vacío
            $reservaciones = [];
        }
    
        // Asegurarse de que $reservaciones siempre sea un array
        $reservaciones = $reservaciones ?? [];
    
        // Pasar $reservaciones a la vista
        return view('Reservaciones.index', compact('reservaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_CLIENTE' => 'required|integer',
            'NOMBRE_CLIENTE' => 'required|string|max:255',
            'NUMERO_TELEFONO' => 'required|numeric',
            'EDAD_CLIENTE' => 'required|integer|min:0',
            'EMAIL_CLIENTE' => 'required|email|max:255',
            'FEC_RESERVACION' => 'required|date',
            'ESTADO' => 'required|string|max:50',
            'NOMBRE_SERVICIO' => 'required|string|max:255',
            'DESCRIPCION_SERVICIO' => 'required|string',
            'PRECIO' => 'required|numeric|min:0',
            'DURACION' => 'required|integer|min:0',
        ]);

        // Realizar la petición POST a la API para insertar la reservación
        $response = Http::post('http://localhost:3000/reservaciones/insertar', [
            'COD_CLIENTE' => $request->COD_CLIENTE,
            'NOMBRE_CLIENTE' => $request->NOMBRE_CLIENTE,
            'NUMERO_TELEFONO' => $request->NUMERO_TELEFONO,
            'EDAD_CLIENTE' => $request->EDAD_CLIENTE,
            'EMAIL_CLIENTE' => $request->EMAIL_CLIENTE,
            'FEC_RESERVACION' => $request->FEC_RESERVACION,
            'ESTADO' => $request->ESTADO,
            'NOMBRE_SERVICIO' => $request->NOMBRE_SERVICIO,
            'DESCRIPCION_SERVICIO' => $request->DESCRIPCION_SERVICIO,
            'PRECIO' => $request->PRECIO,
            'DURACION' => $request->DURACION,
        ]);

        // Redirigir a la lista de reservaciones
        return redirect()->route('reservaciones.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_CLIENTE' => 'required|integer',
            'NOMBRE_CLIENTE' => 'required|string|max:255',
            'NUMERO_TELEFONO' => 'required|numeric',
            'EDAD_CLIENTE' => 'required|integer|min:0',
            'EMAIL_CLIENTE' => 'required|email|max:255',
            'FEC_RESERVACION' => 'required|date',
            'ESTADO' => 'required|string|max:50',
            'NOMBRE_SERVICIO' => 'required|string|max:255',
            'DESCRIPCION_SERVICIO' => 'required|string',
            'PRECIO' => 'required|numeric|min:0',
            'DURACION' => 'required|integer|min:0',
        ]);

        // Realizar la petición PUT a la API para actualizar la reservación
        $response = Http::put("http://localhost:3000/reservaciones/actualizar", [
            'COD_RESERVACION' => $id,
            'COD_CLIENTE' => $request->COD_CLIENTE,
            'NOMBRE_CLIENTE' => $request->NOMBRE_CLIENTE,
            'NUMERO_TELEFONO' => $request->NUMERO_TELEFONO,
            'EDAD_CLIENTE' => $request->EDAD_CLIENTE,
            'EMAIL_CLIENTE' => $request->EMAIL_CLIENTE,
            'FEC_RESERVACION' => $request->FEC_RESERVACION,
            'ESTADO' => $request->ESTADO,
            'NOMBRE_SERVICIO' => $request->NOMBRE_SERVICIO,
            'DESCRIPCION_SERVICIO' => $request->DESCRIPCION_SERVICIO,
            'PRECIO' => $request->PRECIO,
            'DURACION' => $request->DURACION,
        ]);

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            return redirect()
                ->route('reservaciones.index')
                ->with('success', 'Reservación actualizada exitosamente.');
        } else {
            return redirect()
                ->route('reservaciones.index')
                ->with('error', 'Hubo un problema al actualizar la reservación.');
        }
    }
}
