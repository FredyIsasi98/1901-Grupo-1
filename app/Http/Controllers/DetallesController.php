<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API para obtener todos los detalles
        $response = Http::get('http://localhost:3000/compra-detalles/seleccionar');

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $detalles = $response->json();
        } else {
            // Si la API falla, definir $detalles como un array vacío
            $detalles = [];
        }

        // Asegurarse de que $compras siempre sea un array
        $detalles = $detalles ?? [];

        // Pasar $detalles a la vista
        return view('Detalles.index', compact('detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        $response = Http::post('http://localhost:3000/compra-detalles/insertar', [
            'COD_COMPRA' => $request->COD_COMPRA,
            'CANTIDAD' => $request->CANTIDAD,
            'PRECIO' => $request->PRECIO,
        ]);

           return redirect() ->route('detalles.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_COMPRA' => 'required|integer',
            'CANTIDAD' => 'required|integer|min:0',
            'PRECIO' => 'required|numeric|min:0',
        ]);

        // Realizar la petición PUT a la API para actualizar el detalle
        $response = Http::put('http://localhost:3000/compra-detalles/actualizar', [
            'COD_DETALLE' => $id, // Pasamos el ID del detalle como parte del cuerpo
            'COD_COMPRA' => $request->COD_COMPRA,
            'CANTIDAD' => $request->CANTIDAD,
            'PRECIO' => $request->PRECIO,
        ]);

        // Redirigir según el resultado
        if ($response->successful()) {
            return redirect()
                ->route('detalles.index')
                ->with('success', 'Detalle actualizado exitosamente.');
        } else {
            return redirect()
                ->route('detalles.index')
                ->with('error', 'Hubo un problema al actualizar el detalle.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    }
}
