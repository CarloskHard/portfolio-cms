<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::with('contact.client');

        // 1. FILTRO: Estado (Leídos / No leídos)
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // 2. ORDENACIÓN
        $sort = $request->input('sort', 'created_at'); // Por defecto fecha
        $direction = $request->input('direction', 'desc'); // Por defecto nuevos primero

        // Permitimos ordenar por estas columnas
        if (in_array($sort, ['created_at', 'sender_name', 'subject', 'is_read'])) {
            $query->orderBy($sort, $direction);
        }

        $messages = $query->paginate(15)->withQueryString();
        
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        // Al abrirlo, lo marcamos como leído automáticamente
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Mensaje eliminado.');
    }

    // Método para asignar mensaje a un cliente existente
    public function assign(Request $request, Message $message)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id'
        ]);

        // 1. Buscamos o creamos el Contacto dentro del Cliente seleccionado
        $contact = \App\Models\Contact::firstOrCreate(
            [
                'client_id' => $request->client_id,
                'first_name' => $message->sender_name
            ],
            [
                'last_name' => '', // Apellido vacío por defecto
                'notes' => 'Creado automáticamente desde mensaje web'
            ]
        );

        // 2. Guardamos el Email
        if ($message->sender_email) {
            // Usamos firstOrCreate para no duplicar si ya tenía ese email guardado
            $contact->contactMethods()->firstOrCreate(
                [
                    'type' => 'email',
                    'value' => $message->sender_email
                ],
                [
                    'details' => 'Web'
                ]
            );
        }

        // 3. Vinculamos (o re-vinculamos) el mensaje
        $message->update([
            'contact_id' => $contact->id
        ]);

        return redirect()->back()->with('success', 'Cliente asignado y email guardado en la ficha.');
    }
}