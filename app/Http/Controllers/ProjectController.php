<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciamos la consulta
        $query = Project::with(['technologies', 'clients'])->latest();

        // 1. Filtro por Visibilidad (Tipo)
        if ($request->filled('visibility')) {
            $query->where('visibility', $request->visibility);
        }

        // 2. Filtro por Cliente
        if ($request->filled('client_id')) {
            // Buscamos proyectos que tengan asociado este cliente
            $query->whereHas('clients', function ($q) use ($request) {
                $q->where('clients.id', $request->client_id);
            });
        }

        // Paginamos y mantenemos los filtros en la URL al cambiar de página
        $projects = $query->paginate(10)->withQueryString();

        // Necesitamos la lista de clientes para llenar el desplegable del filtro
        $clients = Client::orderBy('commercial_name')->get();

        return view('admin.projects.index', compact('projects', 'clients'));
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        // Pasamos un modelo vacío para que la vista no falle al pedir $project->title
        $project = new \App\Models\Project(); 
        
        $technologies = \App\Models\Technology::all();
        $clients = \App\Models\Client::orderBy('commercial_name')->get();
        
        // Llamamos a la vista 'form' en lugar de 'create'
        return view('admin.projects.form', compact('project', 'technologies', 'clients'));
    }

    /**
     * Muestra el formulario de edición.
     */
    public function edit(Project $project)
    {
        $technologies = Technology::all();
        $clients = Client::orderBy('commercial_name')->get();

        // Llamamos a la MISMA vista 'form'
        return view('admin.projects.form', compact('project', 'technologies', 'clients'));
    }


    /**
     * Actualiza el proyecto en la base de datos.
     */
    public function update(Request $request, Project $project)
    {
        // 1. Validamos y recogemos los datos básicos (título, descripción, etc.)
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'url_repo' => 'nullable|url',
            'url_demo' => 'nullable|url',
            'visibility' => 'required|in:public,private,draft',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
            'clients' => 'nullable|array',
            'clients.*' => 'exists:clients,id',
        ]);

        // 2. Gestión de BORRADO de imagen (Papelera)
        // Si el usuario le dio a la papelera (delete_image = "on" o "1")
        if ($request->boolean('delete_image')) {
            if ($project->image_url) {
                // Borrar archivo físico
                $oldPath = str_replace('storage/', '', $project->image_url);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            // Importante: Marcamos en el array de datos que la imagen es NULL
            $data['image_url'] = null;
        }

        // 3. Gestión de NUEVA imagen
        if ($request->hasFile('image')) {
            // Si había una anterior y no se ha borrado ya en el paso 2, la borramos
            if ($project->image_url && !isset($data['image_url'])) {
                $oldPath = str_replace('storage/', '', $project->image_url);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPath);
            }
            
            // Subimos la nueva
            $imagePath = $request->file('image')->store('projects', 'public');
            // Guardamos la ruta en el array de datos
            $data['image_url'] = 'storage/' . $imagePath;
        }

        // 4. GUARDAR TODO (Aquí es donde estaba el fallo antes)
        // Ahora $data contiene los textos Y la imagen correcta (o null)
        $project->update($data);

        // 5. Sincronizar tecnologías
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

        if ($request->has('clients')) {
            $project->clients()->sync($request->clients);
        } else {
            // Si desmarcan todos (o no envían nada), quitamos relaciones
            if ($project->exists) { 
                $project->clients()->detach();
            }
        }

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    /*
    * Guarda el proyecto nuevo
    */
    public function store(Request $request)
    {
        // 1. Validar
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'url_repo' => 'nullable|url',
            'url_demo' => 'nullable|url',
            'visibility' => 'required|in:public,private,draft',
            'technologies' => 'array', // Array de IDs
            'technologies.*' => 'exists:technologies,id',
            'clients' => 'nullable|array', // Array de IDs de clientes
            'clients.*' => 'exists:clients,id',
        ]);

        // 2. Subir imagen si hay
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $data['image_url'] = 'storage/' . $imagePath;
        }

        // 3. Crear Proyecto
        $project = Project::create($data);

        // 4. Sincronizar Relaciones (Tecnologías y Clientes)
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }
        
        if ($request->has('clients')) {
            $project->clients()->sync($request->clients);
        }

        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente.');
    }

    /**
     * Elimina el proyecto y su imagen asociada.
     */
    public function destroy(Project $project)
    {
        // Borrar imagen del servidor
        if ($project->image_url) {
            $path = str_replace('storage/', '', $project->image_url);
            Storage::disk('public')->delete($path);
        }

        // Borrar registro (la BBDD borrará las relaciones pivote automáticamente por el 'cascade')
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado.');
    }
}
