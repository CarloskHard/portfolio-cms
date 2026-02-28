<nav class="fixed w-full z-50 top-0 start-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-colors duration-300">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse group">
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
                <li><a href="#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">Sobre mí</a></li>
                <li><a href="#skills" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">Habilidades</a></li>
                <li><a href="#projects" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">Proyectos</a></li>
                <li><a href="#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-600 md:p-0 dark:text-white dark:hover:text-indigo-400 dark:hover:bg-gray-700 md:dark:hover:bg-transparent transition">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>