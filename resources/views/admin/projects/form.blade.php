<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Título Dinámico -->
            {{ $project->exists ? __('Editar Proyecto') : __('Crear Nuevo Proyecto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Formulario Dinámico -->
                    <!-- Si existe el proyecto -> Ruta UPDATE. Si no -> Ruta STORE -->
                    <form action="{{ $project->exists ? route('projects.update', $project) : route('projects.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="space-y-6">
                        
                        @csrf
                        
                        <!-- Si editamos, necesitamos el método PUT -->
                        @if($project->exists)
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Título -->
                            <div class="col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">Título del Proyecto</label>
                                <!-- value: Si falla la validación usa 'old', si no, usa el del proyecto (o vacío si es nuevo) -->
                                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <!-- Descripción -->
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $project->description) }}</textarea>
                            </div>

                            <!-- GESTIÓN DE IMAGEN (Con tu código Alpine.js) -->
                            <div class="col-span-2" x-data="imageViewer()">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Imagen de Portada</label>
                                
                                <div class="mb-4 relative w-full sm:w-96" x-show="imageUrl">
                                    <img :src="imageUrl" class="w-full h-auto rounded-lg border border-gray-300 shadow-sm object-cover">
                                    <button type="button" @click="removeImage" 
                                        class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full hover:bg-red-700 shadow-lg transition transform hover:scale-110">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>

                                <input type="file" name="image" id="image" accept="image/*" @change="fileChosen"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                
                                <input type="checkbox" name="delete_image" x-model="deleteFlag" value="1" class="hidden">
                            </div>

                            <!-- URLs -->
                            <div>
                                <label for="url_repo" class="block text-sm font-medium text-gray-700">URL Repositorio</label>
                                <input type="url" name="url_repo" value="{{ old('url_repo', $project->url_repo) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="url_demo" class="block text-sm font-medium text-gray-700">URL Demo</label>
                                <input type="url" name="url_demo" value="{{ old('url_demo', $project->url_demo) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <!-- Visibilidad -->
                        <div class="mt-6">
                            <label for="visibility" class="block text-sm font-medium text-gray-700">Visibilidad</label>
                            <select name="visibility" id="visibility"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="public" {{ old('visibility', $project->visibility) == 'public' ? 'selected' : '' }}>Público</option>
                                <option value="private" {{ old('visibility', $project->visibility) == 'private' ? 'selected' : '' }}>Privado</option>
                                <option value="draft" {{ old('visibility', $project->visibility) == 'draft' ? 'selected' : '' }}>Borrador</option>
                            </select>
                        </div>

                        <!-- Clientes (Relación N:M) -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <h3 class="block text-sm font-medium text-gray-700 mb-3">Cliente Asociado</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-h-48 overflow-y-auto">
                                @foreach($clients as $client)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="clients[]" value="{{ $client->id }}" id="client_{{ $client->id }}"
                                            {{-- Lógica checkbox: Si estamos editando y tiene relación, o si venimos de un error de validación ('old') --}}
                                            @if(
                                                (is_array(old('clients')) && in_array($client->id, old('clients'))) || 
                                                ($project->clients->contains($client->id))
                                            ) checked @endif
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="client_{{ $client->id }}" class="ml-2 block text-sm text-gray-900">
                                            {{ $client->commercial_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tecnologías (Relación N:M) -->
                        <div class="mt-6">
                            <span class="block text-sm font-medium text-gray-700 mb-2">Tecnologías Utilizadas</span>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($technologies as $tech)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="technologies[]" value="{{ $tech->id }}" id="tech_{{ $tech->id }}"
                                            @if(
                                                (is_array(old('technologies')) && in_array($tech->id, old('technologies'))) || 
                                                ($project->technologies->contains($tech->id))
                                            ) checked @endif
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="tech_{{ $tech->id }}" class="ml-2 block text-sm text-gray-900">
                                            {{ $tech->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Botones Dinámicos -->
                        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('projects.index') }}" class="bg-gray-200 py-2 px-4 rounded hover:bg-gray-300 text-gray-700 transition">Cancelar</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition shadow-md">
                                {{ $project->exists ? 'Actualizar Proyecto' : 'Crear Proyecto' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Alpine (Mismo de antes) -->
    <script>
        function imageViewer() {
            return {
                imageUrl: '{{ $project->image_url ? asset($project->image_url) : "" }}',
                deleteFlag: false,

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src);
                    this.deleteFlag = false;
                },

                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return;
                    let file = event.target.files[0],
                        reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = e => callback(e.target.result);
                },

                removeImage() {
                    this.imageUrl = '';
                    this.deleteFlag = true;
                    document.getElementById('image').value = '';
                }
            }
        }
    </script>
</x-app-layout>