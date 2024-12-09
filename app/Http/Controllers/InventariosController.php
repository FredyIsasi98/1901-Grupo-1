<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API
        $response = Http::get('http://localhost:3000/inventario/seleccionar');
    
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $inventarios = $response->json();
        } else {
            // Si la API falla, definir $inventarios como un array vacío
            $inventarios = [];
        }
    
        // Asegurarse de que $inventarios siempre sea un array
        $inventarios = $inventarios ?? [];
    
        // Pasar $inventarios a la vista
        return view('Inventarios.index', compact('inventarios'));
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
        $response = Http::post('http://localhost:3000/inventario/insertar', [
            'COD_DETALLE' => $request->COD_DETALLE,
            'NOMBRE_PRODUCTO' => $request->NOMBRE_PRODUCTO,   
            'DESCRIPCION' => $request->DESCRIPCION,
            'PRECIO' => $request->PRECIO,
            'EXISTENCIAS' => $request->EXISTENCIAS,
        ]);

            return redirect() ->route('inventarios.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    // Validar los datos enviados desde el formulario
    $request->validate([
        'COD_DETALLE' => 'required|integer',
        'NOMBRE_PRODUCTO' => 'required|string|max:255',
        'DESCRIPCION' => 'nullable|string|max:500',
        'PRECIO' => 'required|numeric|min:0',
        'EXISTENCIAS' => 'required|integer|min:0',
    ]);

    // Realizar la petición PUT a la API para actualizar el inventario
    $response = Http::put("http://localhost:3000/inventario/actualizar", [
        'COD_PRODUCTO' => $id, // Pasamos el ID del producto como parte del cuerpo
        'COD_DETALLE' => $request->COD_DETALLE,
        'NOMBRE_PRODUCTO' => $request->NOMBRE_PRODUCTO,
        'DESCRIPCION' => $request->DESCRIPCION,
        'PRECIO' => $request->PRECIO,
        'EXISTENCIAS' => $request->EXISTENCIAS,
    ]);

    // Verificar si la respuesta es exitosa
    if ($response->successful()) {
        // Redirigir a la lista de inventarios con un mensaje de éxito
        return redirect()
            ->route('inventarios.index')
            ->with('success', 'inventario actualizado exitosamente.');
    } else {
        // Redirigir con un mensaje de error si la API falla
        return redirect()
            ->route('inventarios.index')
            ->with('error', 'Hubo un problema al actualizar el inventario.');
        }
    }
}