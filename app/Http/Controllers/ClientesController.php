<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Realizar la petición a la API
        $response = Http::get("$apiUrl/clientes/seleccionar");

        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            $clientes = $response->json();
        } else {
            // Si la API falla, definir $clientes como un array vacío y enviar un mensaje de error
            $clientes = [];
            session()->flash('error', 'No se pudieron cargar los clientes. Inténtelo de nuevo más tarde.');
        }

        // Pasar $clientes a la vista
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create'); // Crear vista para formulario de clientes
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'COD_RESERVACION' => 'required|integer',
            'NOMBRE_CLIENTE' => 'required|string|max:255',
            'EDAD_CLIENTE' => 'required|integer|min:0',
            'DIREC_CLIENTE' => 'required|string|max:255',
            'TELEFONO_CLIENTE' => 'required|string|max:15',
            'EMAIL_CLIENTE' => 'required|email|max:255',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar los datos a la API
        $response = Http::post("$apiUrl/clientes/insertar", [
            'COD_RESERVACION' => $request->COD_RESERVACION,
            'NOMBRE_CLIENTE' => $request->NOMBRE_CLIENTE,
            'EDAD_CLIENTE' => $request->EDAD_CLIENTE,
            'DIREC_CLIENTE' => $request->DIREC_CLIENTE,
            'TELEFONO_CLIENTE' => $request->TELEFONO_CLIENTE,
            'EMAIL_CLIENTE' => $request->EMAIL_CLIENTE,
        ]);

        if ($response->successful()) {
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente registrado exitosamente.');
        } else {
            return redirect()
                ->route('clientes.index')
                ->with('error', 'Hubo un problema al registrar el cliente.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Obtener los datos del cliente desde la API
        $response = Http::get("$apiUrl/clientes/seleccionar/$id");

        if ($response->successful()) {
            $cliente = $response->json();
            return view('clientes.edit', compact('cliente'));
        } else {
            return redirect()
                ->route('clientes.index')
                ->with('error', 'No se pudo cargar la información del cliente.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos enviados desde el formulario
        $request->validate([
            'COD_RESERVACION' => 'required|integer',
            'NOMBRE_CLIENTE' => 'required|string|max:255',
            'EDAD_CLIENTE' => 'required|integer|min:0',
            'DIREC_CLIENTE' => 'required|string|max:255',
            'TELEFONO_CLIENTE' => 'required|string|max:15',
            'EMAIL_CLIENTE' => 'required|email|max:255',
        ]);

        // URL base de la API
        $apiUrl = env('API_URL', 'http://localhost:3000');

        // Enviar la solicitud PUT a la API
        $response = Http::put("$apiUrl/clientes/actualizar", [
            'COD_CLIENTE' => $id,
            'COD_RESERVACION' => $request->COD_RESERVACION,
            'NOMBRE_CLIENTE' => $request->NOMBRE_CLIENTE,
            'EDAD_CLIENTE' => $request->EDAD_CLIENTE,
            'DIREC_CLIENTE' => $request->DIREC_CLIENTE,
            'TELEFONO_CLIENTE' => $request->TELEFONO_CLIENTE,
            'EMAIL_CLIENTE' => $request->EMAIL_CLIENTE,
        ]);

        if ($response->successful()) {
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente actualizado exitosamente.');
        } else {
            return redirect()
                ->route('clientes.index')
                ->with('error', 'Hubo un problema al actualizar el cliente.');
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
        $response = Http::delete("$apiUrl/clientes/eliminar/$id");

        if ($response->successful()) {
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente eliminado exitosamente.');
        } else {
            return redirect()
                ->route('clientes.index')
                ->with('error', 'Hubo un problema al eliminar el cliente.');
        }
    }
}
