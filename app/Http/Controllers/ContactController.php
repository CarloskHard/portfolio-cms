<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\ContactMethod;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Guardar un nuevo contacto asociado a un cliente
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20', // <--- Nuevo campo
            'notes' => 'nullable|string',         // <--- Nuevo campo
        ]);

        // 1. Crear el Contacto (Ahora con notas)
        $contact = $client->contacts()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'notes' => $request->notes,
        ]);

        // 2. Guardar Email (si hay)
        if ($request->filled('email')) {
            $contact->contactMethods()->create([
                'type' => 'email',
                'value' => $request->email,
                'details' => 'Principal'
            ]);
        }

        // 3. Guardar Teléfono (si hay) - Nuevo
        if ($request->filled('phone')) {
            $contact->contactMethods()->create([
                'type' => 'phone',
                'value' => $request->phone,
                'details' => 'Móvil'
            ]);
        }

        return back()->with('success', 'Contacto añadido correctamente.');
    }
    

    // Borrar un contacto
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Contacto eliminado.');
    }
}