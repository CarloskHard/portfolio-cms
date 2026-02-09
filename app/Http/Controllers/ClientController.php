<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /*
     * Listado de clientes.
     */
    public function index(Request $request)
    {
        // 1. Base de la consulta con el conteo de proyectos
        $query = Client::withCount('projects');

        // 2. FILTRO: Si hay un tipo en la URL (?type=company), filtramos
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 3. ORDENACIÓN MEJORADA
        $sort = $request->input('sort');
        $direction = $request->input('direction', 'asc'); // Por defecto A-Z

        if ($sort === 'projects_count') {
            $query->orderBy('projects_count', $direction);
        } elseif ($sort === 'commercial_name') {
            // Ordenar alfabéticamente
            $query->orderBy('commercial_name', $direction);
        } else {
            // Orden por defecto (si no hay nada en la URL): los más nuevos primero
            $query->latest();
        }

        // 4. Paginación (Mantenemos los filtros en los enlaces de página 1, 2, 3...)
        $clients = $query->paginate(10)->withQueryString();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Muestra el formulario de CREACIÓN.
     */
    public function create()
    {
        // PATRÓN MODELO VACÍO:
        // Pasamos un objeto vacío para que la vista 'form' pueda usar $client->commercial_name sin error
        $client = new Client();
        
        return view('admin.clients.form', compact('client'));
    }

    /**
     * Guarda el nuevo cliente en BBDD.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'type' => 'required|in:company,individual',
            'tax_id' => 'nullable|string|max:20', // CIF/NIF
            'notes' => 'nullable|string',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Muestra el formulario de EDICIÓN.
     */
    public function edit(Client $client)
    {
        // Pasamos el cliente existente a la misma vista 'form'
        return view('admin.clients.form', compact('client'));
    }

    /**
     * Actualiza el cliente en BBDD.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'commercial_name' => 'required|string|max:255',
            'type' => 'required|in:company,individual',
            'tax_id' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina el cliente.
     */
    public function destroy(Client $client)
    {
        // Al borrar el cliente, se borrarán las relaciones en la tabla pivote
        // gracias al 'onDelete cascade' de la migración, pero NO los proyectos.
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente eliminado.');
    }
}