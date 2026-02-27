<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- El título será dinámico según la página -->
        <title>@yield('title', 'Portfolio') | {{ env('APP_OWNER_NAME', 'Carlos Codes') }}</title>
        
        <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/spotlight.css', 'resources/js/spotlight.js'])
    </head>
    <body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans flex flex-col min-h-screen transition-colors duration-300">
        
        <!-- NAVBAR (Se repite en todas las páginas) -->
        <nav class="fixed w-full z-50 top-0 start-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-colors">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/logo.png') }}" class="h-10 w-10 rounded-full shadow-sm" alt="Logo">
                    <span class="self-center text-xl font-bold whitespace-nowrap text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">DevPortfolio</span>
                </a>
                
                <div class="flex items-center gap-4 md:order-2">
                    <x-theme-toggle />
                </div>

                <div class="hidden w-full md:block md:w-auto md:order-1">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-transparent">
                        <li><a href="{{ route('home') }}" class="block py-2 px-3 text-gray-900 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 md:p-0 transition">Volver al Inicio</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT (Aquí es donde se inyecta cada página) -->
        <main class="flex-grow mt-20 md:mt-24">
                @yield('content')
        </main>

        <!-- FOOTER (Se repite en todas las páginas) -->
        <footer id="main-footer" class="bg-[#0b0f1a] text-gray-400 py-10 border-t border-gray-800/50 mt-auto">
            <div class="max-w-7xl mx-auto px-8 md:px-12 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="order-2 md:order-1">
                    <p class="text-sm font-light tracking-wide text-gray-500">
                        &copy; {{ date('Y') }} <span class="text-indigo-400 font-medium mx-1 hover:text-indigo-100 transition-colors duration-300">Carlos Codes</span> 
                        <span class="hidden md:inline-block mx-2 text-gray-700">|</span> 
                        <span class="hover:text-indigo-400 transition-colors duration-300">Diseño & Desarrollo</span>
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-center md:justify-end gap-6 order-1 md:order-2">
                    <a href="{{ env('APP_LINKEDIN_URL') }}" target="_blank" class="group">
                        <button type="button" class="footer-btn group-hover:border-[#0077b5] group-hover:text-white">
                            <x-icons.linkedin class="w-5 h-5 transition-colors duration-300" /> 
                            <span class="text-sm font-medium">LinkedIn</span>
                        </button>
                    </a>
                    <a href="{{ env('APP_GITHUB_URL') }}" target="_blank" class="group">
                        <button type="button" class="footer-btn group-hover:border-[#3CCF91] group-hover:text-white">
                            <x-icons.github class="w-5 h-5 transition-colors duration-300" />
                            <span class="text-sm font-medium">GitHub</span>
                        </button>
                    </a>
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