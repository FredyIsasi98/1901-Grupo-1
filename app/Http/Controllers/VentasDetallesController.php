<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class VentasDetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Realizar la petición a la API
        $response = Http::get("$apiUrl/ventas-productos-detalles/seleccionar");

        // Verificar si la respuesta es exitosa
        $ventasdetalles = $response->successful() ? $response->json() : [];
        if (!$response->successful()) {
            session()->flash('error', 'No se pudieron cargar los detalles de ventas. Inténtelo más tarde.');
        }

        // Pasar $ventasdetalles a la vista
        return view('VentasDetalles.index', compact('ventasdetalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Devuelve la vista para crear un nuevo detalle de venta
        return view('VentasDetalles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'COD_VENTA' => 'required|integer|min:1',
            'COD_PRODUCTO' => 'required|integer|min:1',
            'CANTIDAD' => 'required|integer|min:1',
            'PRECIO' => 'required|numeric|min:0.01',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar los datos a la API
        $response = Http::post("$apiUrl/ventas-productos-detalles/insertar", $request->only([
            'COD_VENTA',
            'COD_PRODUCTO',
            'CANTIDAD',
            'PRECIO',
        ]));

        // Verificar el resultado de la operación
        return $response->successful()
            ? redirect()->route('ventasdetalles.index')->with('success', 'Detalle de venta registrado exitosamente.')
            : redirect()->route('ventasdetalles.index')->with('error', 'Hubo un problema al registrar el detalle de venta.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Solicitar datos del detalle a editar
        $response = Http::get("$apiUrl/ventas-productos-detalles/seleccionar/$id");

        if ($response->successful()) {
            $ventasdetalle = $response->json();
            return view('VentasDetalles.edit', compact('ventasdetalle'));
        }

        return redirect()
            ->route('ventasdetalles.index')
            ->with('error', 'No se pudo cargar la información del detalle de venta.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'COD_VENTA' => 'required|integer|min:1',
            'COD_PRODUCTO' => 'required|integer|min:1',
            'CANTIDAD' => 'required|integer|min:1',
            'PRECIO' => 'required|numeric|min:0.01',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar la solicitud PUT a la API
        $response = Http::put("$apiUrl/ventas-productos-detalles/actualizar/$id", $request->only([
            'COD_VENTA',
            'COD_PRODUCTO',
            'CANTIDAD',
            'PRECIO',
        ]));

        // Verificar el resultado de la operación
        return $response->successful()
            ? redirect()->route('ventasdetalles.index')->with('success', 'Detalle de venta actualizado exitosamente.')
            : redirect()->route('ventasdetalles.index')->with('error', 'Hubo un problema al actualizar el detalle de venta.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar solicitud DELETE a la API
        $response = Http::delete("$apiUrl/ventas-productos-detalles/eliminar/$id");

        // Verificar el resultado de la operación
        return $response->successful()
            ? redirect()->route('ventasdetalles.index')->with('success', 'Detalle de venta eliminado exitosamente.')
            : redirect()->route('ventasdetalles.index')->with('error', 'Hubo un problema al eliminar el detalle de venta.');
    }
}
