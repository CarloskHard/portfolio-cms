<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PublicMessageController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|min:10',
        ]);

        // 2. Crear el mensaje
        // No pasamos contact_id porque es un desconocido (null)
        Message::create([
            'sender_name' => $validated['name'],
            'sender_email' => $validated['email'],
            'subject' => 'Nuevo mensaje web de ' . $validated['name'],
            'content' => $validated['content'],
            'is_read' => false,
        ]);

        // 3. Redirigir al ancla #contact con mensaje de éxito
        // Usamos URL::previous() para asegurarnos de que vuelve exactamente donde estaba
        return redirect(URL::previous() . '#contact')
            ->with('status', 'Tu mensaje está en camino ¡Te contestaré pronto!');
    }
}