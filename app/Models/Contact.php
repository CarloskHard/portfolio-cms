<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'first_name', 'last_name', 'position', 'notes'];

    // Pertenece a un Cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Tiene muchos métodos de contacto (email, tlf...)
    public function contactMethods()
    {
        return $this->hasMany(ContactMethod::class);
    }

    // Ha enviado muchos mensajes
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}