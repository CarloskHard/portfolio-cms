@extends('layouts.public')

@section('title', 'Proyectos')

@section('content')
<div class="max-w-screen-xl px-4 mx-auto">
    
    <div class="text-center mb-16">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Portfolio Completo</h1>
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Explora todos mis trabajos, experimentos y desarrollos.</p>
        <div class="w-24 h-1 bg-indigo-600 mx-auto mt-6 rounded"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($projects as $project)
            <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full border border-gray-100 dark:border-gray-700 overflow-hidden group">
                
                <!-- Imagen / Fallback -->
                <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                    @if($project->image_url)
                        <img src="{{ asset($project->image_url) }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('img/logo.png') }}" class="w-16 h-16">
                    @endif
                </div>

                <!-- Contenido -->
                <div class="p-6 flex-1 flex flex-col">
                    <!-- Etiquetas dinámicas-->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project->technologies as $tech)
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $project->title }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3 mb-4 flex-1">
                        {{ $project->description }}
                    </p>
                    
                    <div class="flex gap-4 mt-auto pt-4 border-t border-gray-50 dark:border-gray-700">
                        @if($project->url_repo)
                            <a href="{{ $project->url_repo }}" target="_blank" class="text-xs font-bold uppercase text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                GitHub
                            </a>
                        @endif
                        @if($project->url_demo)
                            <a href="{{ $project->url_demo }}" target="_blank" class="text-xs font-bold uppercase text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Demo
                            </a>
                        @endif
                    </div>
                </div>
            </article>
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
@endsection