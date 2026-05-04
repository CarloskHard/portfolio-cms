@extends('layouts.public')

@section('title', 'Proyectos')

@section('body-class', 'antialiased font-sans flex flex-col min-h-dynamic transition-colors duration-300 text-gray-900 dark:text-gray-100 about-ai-dots-page')

@section('content')
<div class="relative min-h-dynamic overflow-x-hidden bg-transparent dark:bg-transparent">
    <x-ai-dots-background variant="viewport" />
    <!-- pt-28 / lg:pt-36: evitar que el header fijo tape el contenido -->
    <div class="relative z-10 max-w-screen-xl px-4 mx-auto pt-28 pb-16 lg:pt-36 min-h-dynamic">
    
    <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Echa un vistazo a mis trabajos</h1>
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Explora algunos de mis trabajos y desarrollos.</p>
        <div class="w-24 h-1 bg-indigo-600 mx-auto mt-6 rounded"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($projects as $project)
            <!-- Usamos componente de Card -->
            <x-project-card :project="$project" />
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 text-lg">No hay proyectos públicos para mostrar en este momento.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $projects->links() }}
    </div>
    </div>
</div>
@endsection