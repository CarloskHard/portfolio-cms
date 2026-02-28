@extends('layouts.public')

@section('content')

    <!-- HERO SECTION -->
    <section id="home" class="relative pt-32 pb-20 bg-white dark:bg-gray-900 overflow-hidden transition-colors duration-300">
        <canvas id="code-canvas" class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-[1] dark:opacity-[1]"></canvas>

        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 items-center">
            
            <div class="w-full text-center lg:text-left place-self-center lg:col-span-7 z-10 order-2 lg:order-1">
                <span class="inline-block py-1 px-3 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-sm font-semibold mb-4 animate-subtle-breath border border-indigo-200 dark:border-indigo-800/50">
                    🚀 Disponible para nuevos proyectos
                </span>
                <h1 class="max-w-2xl mx-auto lg:mx-0 mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-gray-900 dark:text-white">
                    Hola 👋🏼, soy <br> <span class="text-indigo-600 dark:text-indigo-400">Carlos Codes</span>
                </h1>
                <p class="max-w-2xl mx-auto lg:mx-0 mb-8 font-light text-gray-600 dark:text-gray-400 lg:mb-8 md:text-lg lg:text-xl leading-relaxed">
                    Desarrollador Full Stack web y móvil
                </p>
                
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4">
                    <a href="#projects" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-gray-900 hover:bg-gray-800 dark:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                        Ver Proyectos
                    </a>
                    <a href="#contact" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 dark:text-white dark:border-gray-600 dark:hover:bg-gray-800 transition">
                        Contactar
                    </a>
                    
                    <div class="w-full sm:w-auto h-0 sm:h-8 border-t sm:border-l border-gray-300 dark:border-gray-700 mx-0 sm:mx-2"></div>

                    <a href="{{ env('APP_GITHUB_URL') }}" target="_blank" class="text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white transition" title="GitHub">
                        <x-icons.github class="w-7 h-7" />
                    </a>
                    <a href="{{ env('APP_LINKEDIN_URL') }}" target="_blank" class="text-gray-500 hover:text-[#0077b5] dark:text-gray-400 dark:hover:text-[#0077b5] transition" title="LinkedIn">
                        <x-icons.linkedin class="w-7 h-7" />
                    </a>
                </div>
            </div>
            
            <div class="flex justify-center lg:justify-end relative order-1 lg:order-2 lg:col-span-5 mb-10 lg:mb-0">
                <div class="relative w-56 h-56 sm:w-64 sm:h-64 lg:w-80 lg:h-80">
                    <div class="absolute top-0 right-0 w-48 h-48 sm:w-56 sm:h-56 lg:w-72 lg:h-72 bg-indigo-200 dark:bg-indigo-900 rounded-full blur-3xl opacity-40"></div>
                    
                    <div class="relative w-full h-full rounded-full border-4 border-white dark:border-gray-800 shadow-xl overflow-hidden bg-gray-100 dark:bg-gray-800">
                        <img src="{{ asset('img/me-light.png') }}" onerror="this.src='{{ asset('img/logo.png') }}'" alt="Carlos Codes" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 opacity-100 dark:opacity-0">
                        <img src="{{ asset('img/me.png') }}" onerror="this.src='{{ asset('img/logo.png') }}'" alt="Carlos Codes" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 opacity-0 dark:opacity-100">
                    </div>

                    <div class="absolute bottom-2 left-0 sm:bottom-4 sm:left-0 bg-white dark:bg-gray-800 p-3 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 text-indigo-600 dark:text-indigo-400 animate-floating">
                        <x-icons.laptop class="w-6 h-6 sm:w-8 sm:h-8" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SKILLS SECTION -->
    <section id="skills" class="py-20 bg-gray-50 dark:bg-gray-800 border-y border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Habilidades Técnicas</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-4 rounded-full"></div>
                <p class="text-gray-600 dark:text-gray-300 max-w-4xl mt-4 text-lg leading-relaxed">
                    Trato con una gran gama de tecnologías pues he trabajado desde webs dinámicas (Desde portfolios hasta CRMs, ERPs y CMS) hasta aplicaciones móviles (Tanto nativas como multiplataforma) en completo fullstack.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- CARD 1 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Lenguajes</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">PHP</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">Java</span>
                        <span class="skill-tag">SQL</span>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Frontend</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">Tailwind</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">Blade</span>
                        <span class="skill-tag">Alpine.js</span>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Backend</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">Laravel</span>
                        <span class="skill-tag">Node.js</span>
                        <span class="skill-tag">Spring Boot</span>
                        <span class="skill-tag">REST APIs</span>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M3 5V19A9 3 0 0 0 21 19V5"></path><path d="M3 12A9 3 0 0 0 21 12"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Base de Datos</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">MySQL</span>
                        <span class="skill-tag">PostgreSQL</span>
                        <span class="skill-tag">HeidiSQL</span>
                        <span class="skill-tag">Eloquent ORM</span>
                    </div>
                </div>

                <!-- CARD 5 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect width="16" height="16" x="4" y="4" rx="2"></rect><path d="M15 2v2"></path><path d="M15 20v2"></path><path d="M2 15h2"></path><path d="M20 15h2"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Herramientas</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">Git / GitHub</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">VS Code</span>
                        <span class="skill-tag">Postman</span>
                    </div>
                </div>

                <!-- CARD 6 -->
                <div class="skill-card js-spotlight-card bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:-translate-y-0.5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Diseño</h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="skill-tag">Figma</span>
                        <span class="skill-tag">Wireframing</span>
                        <span class="skill-tag">Responsive</span>
                        <span class="skill-tag">UI/UX</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects" class="py-24 bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-screen-xl px-4 mx-auto">
            <div class="mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Proyectos</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects->take(3) as $project)
                    <article class="project-card js-project-card bg-gray-50 dark:bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 flex flex-col h-full shadow-sm">
                        <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                            @if($project->image_url)
                                <img src="{{ asset($project->image_url) }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('img/logo.png') }}" class="w-16 h-16">
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col relative z-10">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 flex-grow leading-relaxed">{{ $project->description }}</p>

                            <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                @php
                                    $techs = is_string($project->technologies) ? explode(',', $project->technologies) : $project->technologies;
                                @endphp
                                @if($techs)
                                    @foreach($techs as $tech)
                                        <span class="skill-tag">{{ trim($tech instanceof \App\Models\Technology ? $tech->name : $tech) }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-12">No hay proyectos destacados.</p>
                @endforelse
            </div>

            <div class="mt-16 text-center">
                <a href="/proyectos" class="group inline-flex items-center gap-3 px-8 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm tracking-wide transition-all duration-200 hover:scale-105 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 hover:shadow-indigo-500/30">
                    Ver más proyectos 
                    <span class="text-indigo-600 dark:text-indigo-400 font-mono text-lg transition-transform duration-300 group-hover:text-white group-hover:translate-x-1">&lt;&gt;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- SOBRE MÍ SECTION -->
    <section id="about" class="relative py-24 bg-gray-50 dark:bg-gray-800/30 transition-colors duration-300 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 bg-indigo-400/10 dark:bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-screen-xl px-4 mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
                
                <div class="lg:col-span-5 relative group lg:pr-10"> 
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-blue-500 rounded-2xl transform rotate-3 scale-105 opacity-20 dark:opacity-40 transition-transform duration-500 group-hover:rotate-6"></div>
                    <div class="relative overflow-hidden rounded-2xl shadow-xl transition-transform duration-500 group-hover:-translate-y-2 border border-white/50 dark:border-gray-700 bg-white dark:bg-gray-800 p-2">
                        <div class="overflow-hidden rounded-xl">
                            <img src="{{ asset('img/me-alt.png') }}" onerror="this.src='{{ asset('img/logo.png') }}'" alt="Carlos trabajando" class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105">
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -right-2 lg:right-4 bg-white dark:bg-gray-900 p-4 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-4 animate-floating z-20">
                        <div class="bg-indigo-100 dark:bg-indigo-900/50 p-3 rounded-full text-indigo-600 dark:text-indigo-400">
                            <x-icons.cpu class="w-6 h-6" />
                        </div>
                        <div class="whitespace-nowrap">
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Background</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Hardware & Software</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <span class="text-indigo-600 dark:text-indigo-400 font-semibold tracking-wider uppercase text-sm mb-3 block">Conoce mi perfil</span>
                    
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-6 leading-[1.15]">
                        De la precisión aeroespacial a la <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500 dark:from-indigo-400 dark:to-blue-400">arquitectura de software.</span>
                    </h2>

                    <div class="space-y-4 text-base md:text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                        <p>Llevo más de 7 años escribiendo código. Empecé diseñando PCBs en el sector aeroespacial, un entorno donde <strong>un fallo no es una opción</strong>.</p>
                        <p>Esa misma mentalidad de robustez es la que aplico hoy al desarrollo. Dejé los transistores para licenciarme en DAW y DAM, y hoy construyo sistemas que no solo funcionan, sino que escalan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        <div class="flex items-center gap-3 bg-white dark:bg-gray-800/50 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <div class="text-indigo-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg></div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">Sistemas ERP/CRM</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white dark:bg-gray-800/50 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <div class="text-indigo-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">Compose Multiplatform</span>
                        </div>
                    </div>

                    <a href="{{ route('public.about') }}" class="group inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-white bg-gray-900 hover:bg-gray-800 dark:bg-indigo-600 dark:hover:bg-indigo-700 rounded-lg transition-all shadow-md hover:shadow-lg">
                        Conoce mi historia completa
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN DE CONTACTO -->
    <section id="contact" class="py-20 bg-gray-50 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <div class="max-w-screen-md mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">¿Trabajamos juntos?</h2>
                <div class="w-32 h-1.5 bg-indigo-600 mt-4 rounded-full mx-auto"></div>
                
                @if (session('status'))
                    <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
                        {{ session('status') }}
                    </div>
                @else
                    <p class="mt-4 text-gray-500 dark:text-gray-400">Envíame un mensaje y te responderé lo antes posible.</p>
                @endif
            </div>

            <div class="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mensaje</label>
                        <textarea name="content" rows="4" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 transition-colors">{{ old('content') }}</textarea>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
                <div class="mt-5 text-center">
                    <span class="text-sm text-gray-400 mb-3"> O si lo prefieres: </span>
                    <a href="mailto:{{ env('APP_CONTACT_EMAIL') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition opacity-80 hover:opacity-100">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"/></svg>
                        Contactar por email
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                
                form.querySelectorAll('.error-msg, .server-error-banner').forEach(el => el.remove());
                form.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500'));

                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Enviando...
                `;

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                    });

                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        const data = await response.json();

                        if (!response.ok) {
                            if (response.status === 422) {
                                for (const [field, errors] of Object.entries(data.errors)) {
                                    const input = form.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                                        const errorDiv = document.createElement('p');
                                        errorDiv.className = 'error-msg mt-1 text-sm text-red-600 dark:text-red-400 animate-pulse';
                                        errorDiv.innerText = errors[0];
                                        input.parentNode.appendChild(errorDiv);
                                    } else {
                                        mostrarError(form, `Error en el campo backend "${field}": ${errors[0]}`);
                                    }
                                }
                            } else {
                                mostrarError(form, data.message || 'Error desconocido del servidor.');
                            }
                        } else {
                            const successCard = `
                                <div class="flex flex-col items-center justify-center p-8 text-center bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/50 rounded-2xl transition-all duration-500">
                                    <div class="w-16 h-16 bg-green-100 dark:bg-green-800/50 rounded-full flex items-center justify-center mb-6 shadow-sm shadow-green-500/20">
                                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">¡Mensaje Enviado!</h3>
                                    <p class="text-gray-600 dark:text-gray-300">${data.message}</p>
                                </div>
                            `;
                            form.parentElement.innerHTML = successCard;
                        }
                    } else {
                        mostrarError(form, 'Fallo interno del servidor (Error 500).');
                    }
                } catch (error) {
                    mostrarError(form, 'Error de conexión. Revisa tu internet e inténtalo de nuevo.');
                } finally {
                    if (document.body.contains(submitBtn)) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                }
            });

            function mostrarError(formulario, mensaje) {
                const errorBanner = document.createElement('div');
                errorBanner.className = 'server-error-banner p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-xl dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800/50';
                errorBanner.innerHTML = `<strong>Algo salió mal:</strong> ${mensaje}`;
                formulario.prepend(errorBanner);
            }
        }
    });
</script>
@endpush