<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todos los Proyectos | {{ env('APP_OWNER_NAME') }}</title>
        <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        
        <!-- Importante: Asegúrate de que app.css/js están aquí -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/spotlight.css', 'resources/js/spotlight.js'])
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans flex flex-col min-h-screen transition-colors duration-300">
        
        <!-- NAVBAR -->
        <nav class="fixed w-full z-50 top-0 start-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-colors">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/logo.png') }}" class="h-10 w-10 rounded-full shadow-sm" alt="Logo">
                    <span class="self-center text-xl font-bold whitespace-nowrap text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">DevPortfolio</span>
                </a>
                
                <div class="flex items-center gap-4 md:order-2">
                    <!-- AQUÍ VA EL BOTÓN DE TEMA -->
                    <x-theme-toggle />
                </div>

                <div class="hidden w-full md:block md:w-auto md:order-1">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-transparent">
                        <li><a href="{{ route('home') }}" class="block py-2 px-3 text-gray-900 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 md:p-0 transition">Volver al Inicio</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="flex-grow pt-32 pb-20">
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
        </main>

        <!-- FOOTER -->
        <footer id="main-footer" class="bg-[#0b0f1a] text-gray-400 py-10 border-t border-gray-800/50">
            <div class="max-w-7xl mx-auto px-8 md:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
                
                <!-- Créditos (Izquierda) -->
                <div class="order-2 md:order-1">
                    <p class="text-sm font-light tracking-wide text-gray-500">
                        &copy; 2026 <span class="text-indigo-400 font-medium mx-1 hover:text-indigo-100 transition-colors duration-300">Carlos Codes</span> 
                        <span class="hidden md:inline-block mx-2 text-gray-700">|</span> 
                        <span class="hover:text-indigo-400 transition-colors duration-300">Diseño & Desarrollo</span>
                    </p>
                </div>

                <!-- Botones (Derecha) -->
                <div class="flex flex-wrap items-center justify-center md:justify-end gap-6 order-1 md:order-2">
                    
                    <!-- LinkedIn -->
                    <a href="{{ env('APP_LINKEDIN_URL') }}" target="_blank" class="group">
                        <button type="button" class="footer-btn group-hover:border-[#0077b5] group-hover:text-white">
                            <!-- El componente de icono -->
                            <x-icons.linkedin class="w-5 h-5 transition-colors duration-300" /> 
                            <span class="text-sm font-medium">LinkedIn</span>
                        </button>
                    </a>

                    <!-- GitHub (Ejemplo de cómo seguiría) -->
                    <a href="{{ env('APP_GITHUB_URL') }}" target="_blank" class="group">
                        <button type="button" class="footer-btn group-hover:border-[#3CCF91] group-hover:text-white">
                            <x-icons.github class="w-5 h-5 transition-colors duration-300" />
                            <span class="text-sm font-medium">GitHub</span>
                        </button>
                    </a>

                    <!-- Email -->
                    <a href="mailto:{{ env('APP_CONTACT_EMAIL') }}" class="group">
                        <button type="button" class="footer-btn border-l border-gray-800 pl-6 ml-2 group-hover:text-white">
                            <x-icons.email class="w-5 h-5 transition-colors duration-300" />
                            <span class="text-sm font-medium">Email</span>
                        </button>
                    </a>
                </div>
            </div>
        </footer>

    </body>
</html>