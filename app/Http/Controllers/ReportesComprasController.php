<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportesComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Realizar la petición a la API para seleccionar reportes
        $response = Http::get('http://localhost:3000/reportes-compras/seleccionar');
    
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $reportescompras = $response->json();
        } else {
            // Si la API falla, definir $reportes como un array vacío
            $reportescompras = [];
        }
    
        // Asegurarse de que $reportes siempre sea un array
        $reportescompras = $reportescompras ?? [];
    
        // Pasar $reportes a la vista
        return view('ReportesCompras.index', compact('reportescompras'));
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
        $response = Http::post('http://localhost:3000/reportes-compras/insertar', [
            'COD_COMPRA' => $request->COD_COMPRA,
            'FEC_COMPRA' => $request->FEC_COMPRA,
            'TOTAL' => $request->TOTAL,
        ]);

        return redirect()->route('reportescompras.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_COMPRA' => 'required|integer',
            'FEC_COMPRA' => 'required|date',
            'TOTAL' => 'required|numeric|min:0',
        ]);

        // Realizar la petición PUT a la API para actualizar el reporte
        $response = Http::put("http://localhost:3000/reportes-compras/actualizar", [
            'COD_REPORTE_COM' => $id, // Pasamos el ID como parte del cuerpo
            'COD_COMPRA' => $request->COD_COMPRA,
            'FEC_COMPRA' => $request->FEC_COMPRA,
            'TOTAL' => $request->TOTAL,
        ]);

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            // Redirigir a la lista de reportes con un mensaje de éxito
            return redirect()
                ->route('reportescompras.index')
                ->with('success', 'Reporte actualizado exitosamente.');
        } else {
            // Redirigir con un mensaje de error si la API falla
            return redirect()
                ->route('reportescompras.index')
                ->with('error', 'Hubo un problema al actualizar el reporte.');
        }
    }
}
