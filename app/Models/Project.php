<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Campos que permitimos rellenar masivamente (seguridad)
    protected $fillable = [
        'title', 'description', 'image_url', 
        'visibility', 'url_demo', 'url_repo'
    ];

    // Relación N:M con Tecnologías
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    // Relación N:M con Clientes (Uso 'project_client' porque no sigue el orden alfabético estricto de Laravel)
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'project_client');
    }
}
