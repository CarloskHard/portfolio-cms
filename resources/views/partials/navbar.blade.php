{{-- COMPONENTE DE NAVEGACIÓN PÚBLICA --}}
@php
    // Obtenemos el nombre de la ruta actual
    $currentRoute = Route::currentRouteName();
    
    // Estados de navegación
    $isHome = $currentRoute === 'home';
    
    // Cambia 'public.about' por el nombre real de tu ruta de "Sobre mí" completa
    $isAboutPage = $currentRoute === 'public.about'; 
    
    // Detectamos si estamos en el índice de proyectos o viendo un proyecto específico
    $isProjectsPage = request()->routeIs('public.projects'); 
@endphp

<nav class="fixed w-full z-50 top-0 start-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-colors duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse group">
            <img src="{{ asset('img/logo.png') }}" class="h-10 w-10 rounded-full shadow-sm" alt="Logo">
            <span class="self-center text-xl font-bold whitespace-nowrap text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Carlos Codes</span>
        </a>
        
        <div class="flex items-center gap-4 md:order-2">
            <x-theme-toggle />
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 focus:outline-none">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </button>
        </div>

        <div class="hidden w-full md:block md:w-auto" id="navbar-sticky">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                
                <!-- BOTÓN: SOBRE MÍ -->
                <li>
                    @if($isAboutPage)
                        {{-- Estado ACTIVO: Es un span, color índigo, no clicable --}}
                        <span class="block py-2 px-3 text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50 md:bg-transparent md:p-0 cursor-default">
                            Sobre mí
                        </span>
                    @else
                        {{-- Estado INACTIVO: Enlace normal --}}
                        <a href="{{ $isHome ? '#about' : route('home') . '#about' }}" 
                           class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">
                           Sobre mí
                        </a>
                    @endif
                </li>
                
                <!-- BOTÓN: HABILIDADES (Siempre enlace porque suele ser sección de home) -->
                <li>
                    <a href="{{ $isHome ? '#skills' : route('home') . '#skills' }}" 
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">
                       Habilidades
                    </a>
                </li>
                
                <!-- BOTÓN: PROYECTOS -->
                <li>
                    @if($isProjectsPage)
                        {{-- Estado ACTIVO --}}
                        <span class="block py-2 px-3 text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50 md:bg-transparent md:p-0 cursor-default">
                            Proyectos
                        </span>
                    @else
                        {{-- Estado INACTIVO --}}
                        <a href="{{ $isHome ? '#projects' : route('home') . '#projects' }}" 
                           class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">
                           Proyectos
                        </a>
                    @endif
                </li>
                
                <!-- BOTÓN: CONTACTO -->
                <li>
                    <a href="{{ $isHome ? '#contact' : route('home') . '#contact' }}" 
                       class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">
                       Contacto
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>