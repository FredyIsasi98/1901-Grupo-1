<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');
        
        // Realizar la petición a la API
        $response = Http::get("$apiUrl/ventas-productos/seleccionar");
        
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $ventas = $response->json();
        } else {
            // Si la API falla, definir $ventas como un array vacío y enviar un mensaje de error
            $ventas = [];
            session()->flash('error', 'No se pudieron cargar las ventas. Inténtelo de nuevo más tarde.');
        }

        // Pasar $ventas a la vista
        return view('Ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Ventas.create'); // Crear vista para formulario de ventas
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'COD_CLIENTE' => 'required|integer',
            'FEC_VENTA' => 'required|date',
            'TOTAL' => 'required|numeric|min:0',
            'METODO_PAGO' => 'required|string|max:50',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar los datos a la API
        $response = Http::post("$apiUrl/ventas-productos/insertar", [
            'COD_CLIENTE' => $request->COD_CLIENTE,
            'FEC_VENTA' => $request->FEC_VENTA,
            'TOTAL' => $request->TOTAL,
            'METODO_PAGO' => $request->METODO_PAGO,
        ]);

        if ($response->successful()) {
            // Redirigir al índice con un mensaje de éxito
            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta registrada exitosamente.');
        } else {
            // Redirigir al índice con un mensaje de error
            return redirect()
                ->route('ventas.index')
                ->with('error', 'Hubo un problema al registrar la venta.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Obtener los datos de la venta desde la API
        $response = Http::get("$apiUrl/ventas-productos/seleccionar/$id");

        if ($response->successful()) {
            $venta = $response->json();
            return view('Ventas.edit', compact('venta'));
        } else {
            return redirect()
                ->route('ventas.index')
                ->with('error', 'No se pudo cargar la información de la venta.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_CLIENTE' => 'required|integer',
            'FEC_VENTA' => 'required|date',
            'TOTAL' => 'required|numeric|min:0',
            'METODO_PAGO' => 'required|string|max:50',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar la solicitud PUT a la API
        $response = Http::put("$apiUrl/ventas-productos/actualizar", [
            'COD_VENTA' => $id,
            'COD_CLIENTE' => $request->COD_CLIENTE,
            'FEC_VENTA' => $request->FEC_VENTA,
            'TOTAL' => $request->TOTAL,
            'METODO_PAGO' => $request->METODO_PAGO,
        ]);

        if ($response->successful()) {
            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta actualizada exitosamente.');
        } else {
            return redirect()
                ->route('ventas.index')
                ->with('error', 'Hubo un problema al actualizar la venta.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar la solicitud DELETE a la API
        $response = Http::delete("$apiUrl/ventas-productos/eliminar/$id");

        if ($response->successful()) {
            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta eliminada exitosamente.');
        } else {
            return redirect()
                ->route('ventas.index')
                ->with('error', 'Hubo un problema al eliminar la venta.');
        }
    }
}
