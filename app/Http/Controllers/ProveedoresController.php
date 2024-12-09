<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API para obtener todos los proveedores
        $response = Http::get('http://localhost:3000/proveedores/seleccionar');

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $proveedores = $response->json();
        } else {
            // Si la API falla, definir $proveedores como un array vacío
            $proveedores = [];
        }

        // Pasar $proveedores a la vista
        return view('Proveedores.index', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::post('http://localhost:3000/proveedores/insertar', [
            'NOMBRE_PROVEEDOR' => $request->NOMBRE_PROVEEDOR,
            'TELEFONO' => $request->TELEFONO,
            'DIRECCION' => $request->DIRECCION,
            'EMAIL' => $request->EMAIL,
        ]);

        return redirect()->route('proveedores.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'NOMBRE_PROVEEDOR' => 'required|string|max:255',
            'TELEFONO' => 'required|string|max:15',
            'DIRECCION' => 'required|string|max:255',
            'EMAIL' => 'required|email|max:255',
        ]);

        // Realizar la petición PUT a la API para actualizar el proveedor
        $response = Http::put("http://localhost:3000/proveedores/actualizar", [
            'COD_PROVEEDOR' => $id,
            'NOMBRE_PROVEEDOR' => $request->NOMBRE_PROVEEDOR,
            'TELEFONO' => $request->TELEFONO,
            'DIRECCION' => $request->DIRECCION,
            'EMAIL' => $request->EMAIL,
        ]);

        // Redirigir según el resultado
        if ($response->successful()) {
            return redirect()
                ->route('proveedores.index')
                ->with('success', 'Proveedor actualizado exitosamente.');
        } else {
            return redirect()
                ->route('proveedores.index')
                ->with('error', 'Hubo un problema al actualizar el proveedor.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implementa esta función si necesitas eliminar un proveedor
    }
}
