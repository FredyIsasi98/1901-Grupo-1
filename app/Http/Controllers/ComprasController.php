<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API
        $response = Http::get('http://localhost:3000/compra/seleccionar');
    
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $compras = $response->json();
        } else {
            // Si la API falla, definir $compras como un array vacío
            $compras = [];
        }
    
        // Asegurarse de que $compras siempre sea un array
        $compras = $compras ?? [];
    
        // Pasar $compras a la vista
        return view('Compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        $response = Http::post('http://localhost:3000/compra/insertar', [
            'COD_PROVEEDOR' => $request->COD_PROVEEDOR,
            'FEC_COMPRA' => $request->FEC_COMPRA,   
            'TOTAL' => $request->TOTAL,
        ]);

            return redirect() ->route('compras.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    // Validar los datos enviados desde el formulario
    $request->validate([
        'COD_PROVEEDOR' => 'required|integer',
        'FEC_COMPRA' => 'required|date',
        'TOTAL' => 'required|numeric|min:0',
    ]);

    // Realizar la petición PUT a la API para actualizar la compra
    $response = Http::put("http://localhost:3000/compra/actualizar", [
        'COD_COMPRA' => $id, // Pasamos el ID como parte del cuerpo
        'COD_PROVEEDOR' => $request->COD_PROVEEDOR,
        'FEC_COMPRA' => $request->FEC_COMPRA,
        'TOTAL' => $request->TOTAL,
    ]);

    // Verificar si la respuesta es exitosa
    if ($response->successful()) {
        // Redirigir a la lista de compras con un mensaje de éxito
        return redirect()
            ->route('compras.index')
            ->with('success', 'Compra actualizada exitosamente.');
    } else {
        // Redirigir con un mensaje de error si la API falla
        return redirect()
            ->route('compras.index')
            ->with('error', 'Hubo un problema al actualizar la compra.');
        }
    }
}