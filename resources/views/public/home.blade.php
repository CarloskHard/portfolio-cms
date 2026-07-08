@extends('layouts.public')

@section('title', 'Carlos Codex | Desarrollo web y aplicaciones')
@section('meta_description', 'Desarrollo webs, aplicaciones y soluciones digitales a medida. Descubre mis proyectos y cuéntame qué producto necesitas construir.')

@php
    $selectedService = request()->query('service');
    $serviceLeadMessages = [
        'web-development' => 'Quiero una propuesta para desarrollo web. Mi objetivo es...',
        'app-development' => 'Quiero una propuesta para desarrollo de app. Mi objetivo es...',
        'custom-solutions' => 'Quiero hablar sobre una solución a medida para...',
    ];
    $prefilledContactMessage = old('content', $serviceLeadMessages[$selectedService] ?? '');
@endphp

@push('head')
{{-- Preload del retrato del tema activo (el anti-flash ya ha fijado html.dark).
     Ambos retratos siguen cargando eager para que el cambio de tema sea instantáneo;
     este preload solo prioriza el visible para mejorar el LCP. --}}
<script>
    (function () {
        var dark = document.documentElement.classList.contains('dark');
        var l = document.createElement('link');
        l.rel = 'preload';
        l.as = 'image';
        l.href = dark ? @json(asset('img/me-noBg-dark.webp')) : @json(asset('img/me-noBg-light.webp'));
        l.fetchPriority = 'high';
        document.head.appendChild(l);
    })();
</script>
@endpush

@section('content')

    <!--
    |------------------------------------------------------------------|
    |  ################       HERO REDESIGN        ################    |
    |  Dark card design · WebGL shader · AI dots · Portrait           |
    |------------------------------------------------------------------|
    -->
    {{-- Estilos de la home extraidos a resources/css/home.css (cacheable via Vite) --}}
    @push('styles')
        @vite('resources/css/home.css')
    @endpush

    {{-- ── Hero: full-width ─────────────────────────────────────────── --}}
    <section class="hr-hero" id="home" aria-label="Presentación">

            {{-- WebGL tint only (transparent); page background matches body ─────────── --}}
            <div class="hr-hero-bg-clip">
                <canvas id="hr-shader-canvas" class="hr-shader-canvas" aria-hidden="true"></canvas>
            </div>

            <div class="hr-hero-inner">

                {{-- ── LEFT: copy ──────────────────────────────────── --}}
                <div class="hr-hero-copy">

                    {{-- Status row --}}
                    <div class="hr-status-row">
                        <span class="hr-available">
                            <span class="hr-status-dot"></span>Disponible
                        </span>
                        <span class="hr-status-sep">·</span>
                        <span>UTC+1</span>
                    </div>

                    {{-- Headline --}}
                    <h1 class="hr-h1">
                        Desarrollo <span class="hr-accent-word">webs y apps</span><br>
                        que hacen <span class="subrayado-exacto">crecer negocios</span>
                    </h1>

                    {{-- Sub-headline --}}
                    <p class="hr-sub">
                        Ingeniero full‑stack en Sevilla. Diseño, desarrollo y lanzo
                        productos digitales modernos que generan resultados reales.
                    </p>

                    {{-- CTAs --}}
                    <div class="hr-cta-row">
                        <a class="hr-btn hr-btn-primary" href="{{ route('public.contact') }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                            Solicitar proyecto
                        </a>
                        <a class="hr-btn hr-btn-ghost" href="#projects">
                            <svg class="demo-eye-blink" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            Ver trabajos
                        </a>
                    </div>

                    {{-- Tech rail --}}
                    <div class="hr-tech-rail">
                        <span class="hr-tech">
                            <x-icons.tech-react />
                            React
                        </span>
                        <span class="hr-tech">
                            <x-icons.tech-node-js />
                            Node.js
                        </span>
                        <span class="hr-tech">
                            <x-icons.tech-kotlin />
                            Kotlin
                        </span>
                        <span class="hr-tech">
                            <x-icons.tech-laravel />
                            Laravel
                        </span>
                        <span class="hr-tech">
                            <x-icons.tech-aws />
                            AWS
                        </span>
                    </div>

                </div>{{-- /hr-hero-copy --}}

                {{-- ── RIGHT: dots panel + portrait --}}
                <div class="hr-hero-right">
                    <div class="hr-photo-stage">
                        {{-- Dots background (shared x-ai-dots-background component) --}}
                        <x-ai-dots-background variant="hero" :waves-overlay="false" />
                        <div class="hr-photo-glow" aria-hidden="true"></div>
                        <img class="hr-portrait-inline hr-portrait-light"
                             src="{{ asset('img/me-noBg-light.webp') }}"
                             alt="Carlos — Fullstack Developer"
                             width="520" height="720"
                             decoding="async">
                        <img class="hr-portrait-inline hr-portrait-dark"
                             src="{{ asset('img/me-noBg-dark.webp') }}"
                             alt="Carlos — Fullstack Developer"
                             width="520" height="720"
                             decoding="async">
                    </div>
                </div>{{-- /hr-hero-right --}}

            </div>{{-- /hr-hero-inner --}}

            {{-- Portrait anchored to the bottom of the hero card --}}
            {{-- Capa decorativa duplicada (aria-hidden): alt vacío; el alt descriptivo va en las inline --}}
            <div class="hr-portrait-layer" aria-hidden="true">
                <img class="hr-portrait-light"
                     src="{{ asset('img/me-noBg-light.webp') }}"
                     alt=""
                     width="520" height="720"
                     loading="eager" decoding="async">
                <img class="hr-portrait-dark"
                     src="{{ asset('img/me-noBg-dark.webp') }}"
                     alt=""
                     width="520" height="720"
                     loading="eager" decoding="async">
            </div>

            {{-- Floating idea card (hidden temporarily) --}}
            {{--
            <aside class="hr-idea-card">
                <div class="hr-idea-head">
                    <span style="display:inline-block;width:6px;height:6px;border-radius:999px;background:var(--hr-accent-2);"></span>
                    ¿Tienes una idea?
                </div>
                <p>La convierto en un producto digital sólido y escalable.</p>
                <a class="hr-idea-arrow" href="#contact" aria-label="Cuéntame tu idea">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
            </aside>
            --}}

    </section>{{-- /hr-hero --}}

    {{-- ── Stats strip: centered wrapper ──────────────────────────── --}}
    <div class="hr-stats-wrapper">
        <section class="hr-stats" aria-label="Indicadores">

            <div class="hr-stat" data-reveal data-reveal-delay="0">
                <div class="hr-stat-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .587l3.668 7.431L24 9.25l-6 5.847L19.336 24 12 19.897 4.664 24 6 15.097 0 9.25l8.332-1.232z"/></svg>
                </div>
                <div class="hr-stat-text">
                    <span class="hr-stat-title">A medida</span>
                    <span class="hr-stat-sub">Soluciones web escalables</span>
                </div>
            </div>

            <div class="hr-stat" data-reveal data-reveal-delay="70">
                <div class="hr-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="hr-stat-text">
                    <span class="hr-stat-title">Clientes satisfechos</span>
                    <span class="hr-stat-sub">Trabajo cercano y transparente</span>
                </div>
            </div>

            <div class="hr-stat" data-reveal data-reveal-delay="140">
                <div class="hr-stat-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/></svg>
                </div>
                <div class="hr-stat-text">
                    <span class="hr-stat-title">Respuesta en 24h</span>
                    <span class="hr-stat-sub">Atención rápida y directa</span>
                </div>
            </div>

            <div class="hr-stat" data-reveal data-reveal-delay="210">
                <div class="hr-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="hr-stat-text">
                    <span class="hr-stat-title">Freelance disponible</span>
                    <span class="hr-stat-sub">Nuevos proyectos</span>
                </div>
            </div>

        </section>{{-- /hr-stats --}}
    </div>{{-- /hr-stats-wrapper --}}


    <!--
    |------------------------------------------------------------------|
    |  ##########             SERVICIOS SECTION            ##########  |                
    |------------------------------------------------------------------|
    -->
    <section id="services" class="relative z-10 transition-colors duration-300 mx-3 md:mx-6 lg:mx-10 mt-8 mb-8">
      <div class="max-w-screen-xl px-4 mx-auto">
        <div class="hr-section-card services">
          <div class="services-head" data-reveal>
            <span class="eyebrow"><span class="dot"></span>Mis servicios</span>
            <h2>Soluciones digitales <span class="accent">a medida</span> para tu negocio</h2>
            <p>Desde la idea hasta el lanzamiento. Me encargo de todo el proceso para que tú te centres en lo importante.</p>
            <a class="pill-cta" href="{{ route('public.services') }}">
              Explorar servicios
              <span class="arrow">→</span>
            </a>
          </div>

          <div class="services-grid">
            <div class="svc" data-reveal data-reveal-delay="0">
              <span class="svc-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"></rect><path d="M8 21h8M12 17v4"></path></svg>
              </span>
              <h3>Desarrollo Web</h3>
              <p>Páginas rápidas, modernas y optimizadas para convertir.</p>
              <ul>
                <li><x-icons.check />Landing pages</li>
                <li><x-icons.check />Webs corporativas</li>
                <li><x-icons.check />E‑commerce</li>
              </ul>
              <a href="{{ route('public.services.web') }}" class="pill-cta">Ver servicio</a>
            </div>

            <div class="svc" data-reveal data-reveal-delay="85">
              <span class="svc-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"></rect><line x1="12" y1="18" x2="12" y2="18"></line></svg>
              </span>
              <h3>Apps Móviles</h3>
              <p>Apps nativas Android y multiplataforma con excelente experiencia.</p>
              <ul>
                <li><x-icons.check />Android (Kotlin)</li>
                <li><x-icons.check />Apps multiplataforma</li>
                <li><x-icons.check />Integraciones y APIs</li>
              </ul>
              <a href="{{ route('public.services.app') }}" class="pill-cta">Ver servicio</a>
            </div>

            <div class="svc" data-reveal data-reveal-delay="170">
              <span class="svc-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
              </span>
              <h3>Soluciones a medida</h3>
              <p>Si no encaja en un servicio estándar, definimos juntos una solución personalizada.</p>
              <ul>
                <li><x-icons.check />APIs y backends</li>
                <li><x-icons.check />Paneles administrativos</li>
                <li><x-icons.check />Integraciones externas</li>
              </ul>
              <a href="{{ route('public.contact', ['interest' => 'web']) }}" class="pill-cta">Hablar de mi caso</a>
            </div>
          </div>

          <div class="services-footer" data-reveal data-reveal-delay="60">
            Tecnología moderna. Código limpio. <span class="accent">Resultados reales.</span>
          </div>
        </div>
      </div>
    </section>


    <!--
    |------------------------------------------------------------------|
    |  ##########             SOBRE MI SECTION             ##########  |
    |------------------------------------------------------------------|
    -->
    <section id="about" class="relative py-24 bg-transparent transition-colors duration-300 overflow-x-clip">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 bg-indigo-400/10 dark:bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-500/10 dark:bg-indigo-500/18 rounded-full blur-3xl pointer-events-none hidden md:block"></div>

        <div class="max-w-screen-xl px-4 mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                <div class="lg:col-span-5 relative group lg:pr-10" data-reveal data-reveal-direction="left">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-blue-500 rounded-2xl transform rotate-3 scale-105 opacity-20 dark:opacity-40 transition-transform duration-500 group-hover:rotate-6"></div>
                    <div class="relative overflow-hidden rounded-2xl shadow-xl transition-transform duration-500 group-hover:-translate-y-2 border border-white/50 dark:border-gray-700 bg-white dark:bg-gray-800 p-2">
                        <div class="relative overflow-hidden rounded-xl">
                            <img src="{{ asset('img/logo.svg') }}" alt="" aria-hidden="true" class="absolute inset-x-0 top-0 w-full h-auto object-contain p-8 translate-x-1 translate-y-4 scale-[0.98] opacity-25 blur-[3px] brightness-0 pointer-events-none select-none">
                            <img src="{{ asset('img/logo.svg') }}" alt="Logo Carlos Codex" class="relative w-full h-auto object-contain p-8 transform transition-transform duration-700 group-hover:scale-105 drop-shadow-[2px_14px_26px_rgba(15,23,42,0.22)] dark:drop-shadow-[2px_14px_30px_rgba(154,209,210,0.18)]">
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-2 lg:right-4 bg-white dark:bg-gray-900 p-4 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-4 animate-floating z-20">
                        <div class="bg-indigo-100 dark:bg-indigo-900/50 p-3 rounded-full text-indigo-600 dark:text-indigo-400">
                            <x-icons.cpu class="w-6 h-6" />
                        </div>
                        <div class="whitespace-nowrap">
                            <p class="text-[10px] text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">+7 años de experiencia</p>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Desarrollando software</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal data-reveal-delay="150" data-reveal-direction="right">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                        </span>
                        <span class="text-indigo-600 dark:text-indigo-400 font-bold tracking-widest uppercase text-xs">Conoce mi perfil</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-6 leading-[1.15]">
                        Diseñando y programando apps y webs con la mejor <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500 dark:from-indigo-400 dark:to-blue-400">arquitectura de software.</span>
                    </h2>
                    <div class="space-y-4 text-base md:text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                        <p>Empecé como profesional en el sector electrónico aeroespacial, un entorno <strong>científico y metódico</strong>.</p>
                        <p>Con el tiempo decidí licenciarme como programador web y de aplicaciones y actualmente llevo <strong>más de 7 años</strong> combinando una metodología científica y mi visión creativa para construir proyectos modernos y óptimos para particulares y empresas.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                        <div class="flex items-center gap-3 bg-white dark:bg-gray-800/50 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <div class="text-indigo-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg></div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">Sistemas ERP, CRM y CMS</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white dark:bg-gray-800/50 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <div class="text-indigo-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">Desarrollo móvil</span>
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


    <!--
    |------------------------------------------------------------------|
    |  ##########              SKILLS SECTION              ##########  |
    |------------------------------------------------------------------|
    -->
    <section id="skills" x-data="skillsComponent()" class="relative z-10 py-24 transition-colors duration-300 mx-3 md:mx-6 lg:mx-10 mt-8 mb-8">
        <div class="max-w-screen-xl px-4 mx-auto relative">
            <div class="hr-section-card">
            <div class="mb-12" data-reveal>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Stack Tecnológico</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-4 rounded-full"></div>
                <p class="text-gray-600 dark:text-gray-300 max-w-4xl mt-4 text-lg leading-relaxed">
                    Trabajo con una gran gama de tecnologías de desarrollo, tanto web (Portfolios, CRMs, ERPs y CMS) como en aplicaciones móviles y multiplataforma. Todo en <strong>completo fullstack</strong>.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="(skill, key) in skillsData" :key="key">
                    <div @click="openModal(key)"
                         @keydown.enter.prevent="openModal(key)"
                         @keydown.space.prevent="openModal(key)"
                         role="button" tabindex="0"
                         :aria-label="`Ver detalle de ${skill.title}`"
                         class="skill-card js-spotlight-card section-inner-card group cursor-pointer rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col h-full relative overflow-hidden" data-reveal>
                        <div class="flex items-center gap-4 mb-5 relative z-10">
                            <div :class="`p-3 rounded-xl ${skill.bg} ${skill.color} transition-transform group-hover:scale-110`">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="skill.icon"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight" x-text="skill.title"></h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-auto relative z-10">
                            <template x-for="(tech, index) in skill.technologies.slice(0, 4)" :key="index">
                                <img :src="tech.badge" :alt="tech.name" class="h-6 rounded shadow-sm">
                            </template>
                            <span x-show="skill.technologies.length > 4" class="flex items-center px-2 py-1 text-xs font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 rounded" x-text="`+${skill.technologies.length - 4}`"></span>
                        </div>
                        <div class="skill-cta-hint mt-5 pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center gap-3 text-sm font-medium text-indigo-600 dark:text-indigo-400 relative z-10">
                            <span>
                                <span class="md:hidden">Pulsa para ver más detalles</span>
                                <span class="hidden md:inline">Ver detalle de tecnologías</span>
                            </span>
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </template>
            </div>
            </div>{{-- /hr-section-card --}}
        </div>

        <template x-teleport="body">
        <div
            x-show="modalOpen"
            style="display: none;"
            class="skills-modal-overlay"
            role="dialog"
            aria-modal="true"
            @keydown.escape.window="closeModal()"
        >
            <div
                x-show="modalOpen"
                x-transition.opacity.duration.300ms
                @click="closeModal()"
                class="skills-modal-backdrop"
            ></div>
            <div class="skills-modal-stage">
                <div x-show="modalOpen"
                    x-transition:enter="ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-y-8 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-8 sm:scale-95"
                    class="skills-modal-panel relative z-20 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-xl border border-gray-200 dark:border-gray-700 transition-all duration-500 pointer-events-auto">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                        <div class="flex items-center gap-3">
                            <template x-if="activeSkill">
                                <div :class="`p-2 rounded-lg ${activeSkill.bg} ${activeSkill.color}`">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="activeSkill.icon"></path></svg>
                                </div>
                            </template>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white" x-text="activeSkill?.title"></h3>
                        </div>
                        <button @click="closeModal()" aria-label="Cerrar detalle" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    <div class="px-6 py-6">
                        <div x-show="activeSkill?.image" class="mb-5 overflow-hidden rounded-xl h-32 md:h-40 bg-gray-100 dark:bg-gray-800">
                            <img :src="activeSkill?.image" :alt="activeSkill?.title" class="w-full h-full object-cover opacity-90">
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-6 bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl" x-html="activeSkill?.description"></p>
                        <h4 class="text-xs font-bold tracking-wider uppercase text-gray-500 dark:text-gray-400 mb-4 flex items-center gap-2">
                            Haz clic en una tecnología
                            <svg class="w-4 h-4 text-indigo-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                        </h4>
                        <div class="flex flex-wrap gap-3 mb-2">
                            <template x-for="(tech, index) in activeSkill?.technologies" :key="index">
                                <img :src="tech.badge" :alt="tech.name"
                                    @click="openTech(tech)"
                                    @keydown.enter.prevent="openTech(tech)"
                                    @keydown.space.prevent="openTech(tech)"
                                    role="button" tabindex="0"
                                    :aria-pressed="(activeTech === tech).toString()"
                                    class="h-8 rounded shadow-sm transition-all duration-300 cursor-pointer ring-offset-2 dark:ring-offset-gray-900"
                                    :class="activeTech === tech ? 'ring-2 ring-indigo-500 scale-105 opacity-100' : 'hover:scale-105 opacity-80 hover:opacity-100 grayscale-[20%] hover:grayscale-0'">
                            </template>
                        </div>
                    </div>
                </div>
                <div x-show="showTechDetails"
                    x-transition:enter="transition-all duration-500 cubic-bezier(0.4, 0, 0.2, 1)"
                    x-transition:enter-start="opacity-0 !-mt-[20rem] md:!mt-0 md:!-ml-[24rem] scale-95"
                    x-transition:enter-end="opacity-100 mt-4 md:mt-0 md:ml-6 scale-100"
                    x-transition:leave="transition-all duration-300 ease-in"
                    x-transition:leave-start="opacity-100 mt-4 md:mt-0 md:ml-6 scale-100"
                    x-transition:leave-end="opacity-0 !-mt-[20rem] md:!mt-0 md:!-ml-[24rem] scale-95"
                    class="skills-modal-panel relative z-10 w-full max-w-sm bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-gray-700 pointer-events-auto mt-4 md:mt-0 md:ml-6">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <img :src="activeTech?.badge" :alt="activeTech?.name" class="h-8 rounded shadow-sm">
                            <button @click="closeTech()" type="button" aria-label="Cerrar experiencia" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 bg-gray-100 dark:bg-gray-700 p-1 rounded-full transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <h4 class="text-lg font-extrabold text-gray-900 dark:text-white mb-2">Mi experiencia</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed" x-text="activeTech?.description"></p>
                    </div>
                </div>
            </div>
        </div>
        </template>
    </section>


    <!--
    |------------------------------------------------------------------|
    |  ##########             PROJECTS SECTION             ##########  |
    |------------------------------------------------------------------|
    -->
    <section id="projects" class="relative py-24 bg-transparent transition-colors duration-300">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 bg-indigo-500/10 dark:bg-indigo-500/18 rounded-full blur-3xl pointer-events-none hidden lg:block"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-500/10 dark:bg-indigo-500/18 rounded-full blur-3xl pointer-events-none hidden md:block"></div>
        <div class="max-w-screen-xl px-4 mx-auto relative z-10">
            <div class="mb-16" data-reveal>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Proyectos</h2>
                <div class="w-20 h-1.5 bg-indigo-600 mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal data-reveal-delay="100">
                @forelse($projects as $index => $project)
                    <div @class(['hidden md:block lg:hidden' => $index === 3])>
                        <x-project-card :project="$project" />
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-12">No hay proyectos destacados.</p>
                @endforelse
            </div>
            <div class="mt-16 text-center" data-reveal data-reveal-delay="80">
                <a href="/proyectos" class="group inline-flex items-center gap-3 px-8 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm tracking-wide transition-all duration-200 hover:scale-105 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 hover:shadow-indigo-500/30">
                    Ver más proyectos
                    <span class="text-indigo-600 dark:text-indigo-400 font-mono text-lg transition-transform duration-300 group-hover:text-white group-hover:translate-x-1">&lt;&gt;</span>
                </a>
            </div>
        </div>
    </section>


    <!--
    |------------------------------------------------------------------|
    |  ##########        CONTACT (acceso al asistente)      ##########  |
    |------------------------------------------------------------------|
    -->
    <section id="contact" class="relative z-10 py-24 transition-colors duration-300 mx-3 md:mx-6 lg:mx-10 mt-8 mb-10">
        <div class="max-w-screen-lg mx-auto px-4 relative z-10">
            <div class="hr-section-card hr-contact-card" data-reveal>
                <div class="hr-contact-content">
                    <div class="hr-contact-kicker">
                        <span aria-hidden="true"></span>
                        Nuevo proyecto
                    </div>
                    <h2 class="hr-contact-title">
                        ¿Tienes una idea en mente?
                    </h2>
                    <p class="hr-contact-copy">
                        Cuéntame qué quieres construir y te responderé con una primera orientación clara.
                    </p>
                    <div class="hr-contact-points" aria-label="Ventajas del contacto">
                        <span>Sin compromiso</span>
                        <span>Respuesta en menos de 24 h</span>
                        <span>Por el canal que prefieras</span>
                    </div>
                    <div class="hr-contact-actions">
                        <a href="{{ route('public.contact') }}" class="hr-contact-primary">
                            Empezar conversación
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        @if(filled(config('contact.email')))
                            <a href="mailto:{{ config('contact.email') }}" class="hr-contact-secondary">
                                Escribir por correo
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')
{{-- Reveal (data-reveal) + shader WebGL del hero: modulo Vite --}}
@vite('resources/js/home-hero.js')


{{-- Tarjetas skills técnicas --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('skillsComponent', () => ({
        modalOpen: false,
        activeSkill: null,
        activeTech: null,
        showTechDetails: false,
        _skillCardsIo: null,
        _skillCardsMqHandler: null,

        init() {
            this.$nextTick(() => this.bindSkillCardViewportHints());
        },

        bindSkillCardViewportHints() {
            const sectionEl = this.$el;
            if (!sectionEl || !window.IntersectionObserver) return;

            const mq = window.matchMedia('(max-width: 767px)');
            const clearClasses = () => {
                sectionEl.querySelectorAll('.skill-card').forEach((el) => el.classList.remove('skill-card--in-view'));
            };
            const stop = () => {
                if (this._skillCardsIo) {
                    this._skillCardsIo.disconnect();
                    this._skillCardsIo = null;
                }
                clearClasses();
            };
            const start = () => {
                if (this._skillCardsIo) return;
                this._skillCardsIo = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((e) => {
                            e.target.classList.toggle('skill-card--in-view', e.isIntersecting);
                        });
                    },
                    { threshold: 0.35, rootMargin: '0px 0px -6% 0px' },
                );
                sectionEl.querySelectorAll('.skill-card').forEach((el) => this._skillCardsIo.observe(el));
            };
            const sync = () => {
                if (mq.matches) start();
                else stop();
            };

            if (this._skillCardsMqHandler) {
                if (typeof mq.removeEventListener === 'function') {
                    mq.removeEventListener('change', this._skillCardsMqHandler);
                } else {
                    mq.removeListener(this._skillCardsMqHandler);
                }
            }
            this._skillCardsMqHandler = sync;
            if (typeof mq.addEventListener === 'function') mq.addEventListener('change', this._skillCardsMqHandler);
            else mq.addListener(this._skillCardsMqHandler);
            sync();
        },
        
        skillsData: {
            web: {
                title: 'Desarrollo Web & Frameworks',
                image: '{{ asset('img/skills/web.svg') }}',
                icon: 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
                color: 'text-indigo-600 dark:text-indigo-400',
                bg: 'bg-indigo-50 dark:bg-indigo-900/30',
                description: 'Mi núcleo de trabajo diario. Monto webs de portfolio, tiendas online, ERPs(Gestión de recursos internos para negocios) y CRMs.(Sistemas internos para gestión de clientes).',
                technologies:[
                    { name: 'Laravel', badge: '{{ asset('img/badges/laravel.svg') }}', description: 'Mi framework principal de backend: Me permite desplegar webs sólidas en minutos. Lo utilizo a diario para gestionar autenticaciones seguras y orquestar toda la lógica de negocio de mis proyectos usando Eloquent ORM.' },
                    { name: 'PHP', badge: '{{ asset('img/badges/php.svg') }}', description: 'Es el estándar en desarrollo web; PHP es el motor de la mayoría de mis desarrollos backend. He evolucionado con el lenguaje, aprovechando su tipado fuerte en las últimas versiones para escribir código limpio, moderno y orientado a objetos.' },
                    { name: 'JavaScript', badge: '{{ asset('img/badges/javascript.svg') }}', description: 'Lo uso para dar vida a mis interfaces. Desde manipular el DOM de forma directa hasta consumir mis propias APIs asíncronas, es mi herramienta clave para crear una experiencia de usuario fluida.' },
                    { name: 'Tailwind CSS', badge: '{{ asset('img/badges/tailwind-css.svg') }}', description: 'Mi framework CSS de cabecera. Es una mejora a simplemente usar CSS: Agiliza enormemente mi flujo de trabajo maquetando directamente en el HTML lo cual crea un código más limpio y mejor arquitectura. CSS todavía tiene sus usos, especialmente para elementos repetitivos/consistentes.' },
                    { name: 'HTML5', badge: '{{ asset('img/badges/html5.svg') }}', description: 'La base de todo proyecto web. He usado HTML en todos mis proyectos web ( Aunque obviamente en proyectos con CMS no se usa apenas pues se programa mediante bloques, lo cual puede servir para proyectos rápidos y simples, pero no hay nada tan flexible y básico para diseñar web como HTML).' },
                    { name: 'CSS3', badge: '{{ asset('img/badges/css3.svg') }}', description: 'Aunque use frameworks CSS, el uso de CSS nativo sigue teniendo cabida para los detalles precisos o cuando se repite un estilo en varios elementos. Además también lo he trabajado en proyectos no tan modernos mientras trabajé con empresas de ERP.' },
                    { name: 'jQuery', badge: '{{ asset('img/badges/jquery.svg') }}', description: 'Me ha salvado la vida al tomar el relevo de proyectos heredados. Aún lo utilizo para dar mantenimiento a sistemas más antiguos o implementar scripts rápidos de validación.' },
                    { name: 'Bootstrap', badge: '{{ asset('img/badges/bootstrap.svg') }}', description: 'Mi opción rápida y segura cuando necesito levantar el panel de administración de un CRM o un dashboard interno. Me permite entregar prototipos funcionales y estables en tiempo récord.' }
                ]
            },
            movil: {
                title: 'Desarrollo Multiplataforma & Móvil',
                image: '{{ asset('img/skills/movil.svg') }}',
                icon: 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                color: 'text-green-600 dark:text-green-400',
                bg: 'bg-green-50 dark:bg-green-900/30',
                description: 'Desarrollo apps nativas para Android que luego también puedo adaptar a dispositivos de Apple (IOS). Además he diseñado videojuegos en Unity para móviles y VR.',
                technologies:[
                    { name: 'Kotlin', badge: '{{ asset('img/badges/kotlin.svg') }}', description: 'Es el lenguaje recomendado para el desarrollo móvil y lo he estado usando intensivamente al desarrollar apps nativas como mi aplicación "Platorama". Es uno de los lenguajes con los que más familiarizado estoy al haber pasado mucho tiempo desarrollando en Android Studio.' },
                    { name: 'Android Studio', badge: '{{ asset('img/badges/android-studio.svg') }}', description: 'Mi centro de operaciones para crear apps móviles. Aquí es donde gestiono todo el ciclo de vida: desde el diseño de la interfaz y la inyección de dependencias, hasta el perfilado de rendimiento y la compilación final.' },
                    { name: 'C++', badge: '{{ asset('img/badges/cpp.svg') }}', description: 'C++ es un lenguaje pilar de la programación y actualmente sigue teniendo uso para programación a bajo nivel. Aunque no estoy tan familiarizado con él, sí que lo he estudiado y estado usando durante un tiempo para diseñar juegos en Unreal Engine.' },
                    { name: 'C#', badge: '{{ asset('img/badges/csharp.svg') }}', description: 'El lenguaje que utilizo principalmente como motor lógico detrás de Unity. Con él he programado comportamientos complejos, físicas y herramientas personalizadas orientadas a objetos.' },
                    { name: 'Unity', badge: '{{ asset('img/badges/unity.svg') }}', description: 'Mi motor de desarrollo de confianza para desarrollar apps interactivas y videojuegos. Lo he utilizado para desarrollar tanto videojuegos (de móvil y PC) como simulaciones y entornos inmersivos de realidad virtual (VR).' }
                ]
            },
            ecommerce: {
                title: 'E-commerce, ERPs & CMS',
                image: '{{ asset('img/skills/ecommerce.svg') }}',
                icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                color: 'text-pink-600 dark:text-pink-400',
                bg: 'bg-pink-50 dark:bg-pink-900/30',
                description: 'Digitalizo negocios implementando tiendas online y desarrollando programas internos de gestión de los recursos (ERP) y clientes (CRM).',
                technologies:[
                    { name: 'PrestaShop', badge: '{{ asset('img/badges/prestashop.svg') }}', description: 'Lo utilizo para montar tiendas online rápidamente con un sistema ya establecido. He trabajado con él durante mi trabajo como programador en "Al Rescate". No solo lo he configurado, también he desarrollado módulos a medida en PHP y adaptado plantillas para cubrir flujos de venta B2B y B2C muy específicos.' },
                    { name: 'Dolibarr ERP', badge: '{{ asset('img/badges/dolibarr-erp.svg') }}', description: 'He usado este sistema para digitalizar la gestión de empresas durante mi trabajo en "Al rescate". Lo he usado para darle a clientes el control total de facturación, almacén e incluso lo he sincronizado por API con sus tiendas web.' },
                    { name: 'Stripe', badge: '{{ asset('img/badges/stripe.svg') }}', description: 'Pagos online y facturación: Checkout, Payment Intents, webhooks y cuentas conectadas cuando hace falta marketplace. Lo integro desde backend (Laravel u otros) para no depender de plugins rígidos y controlar flujos, idempotencia y seguridad (SCA, 3DS) al detalle.' },
                    { name: 'Laravel Cashier', badge: '{{ asset('img/badges/laravel-cashier.svg') }}', description: 'Para SaaS y tiendas con suscripciones en Laravel: planes, pruebas, renovaciones y portal de facturación del cliente sobre Stripe. Encaja con mi stack habitual y sube el nivel frente a solo “instalar un plugin de pago”.' }
                ]
            },
            bbdd: {
                title: 'Bases de Datos (SGBD)',
                image: '{{ asset('img/skills/bbdd.svg') }}',
                icon: 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
                color: 'text-blue-600 dark:text-blue-400',
                bg: 'bg-blue-50 dark:bg-blue-900/30',
                description: 'Todo proyecto complejo en el que trabajo requiere gestión de datos: Diseño estructuras de datos buscando los mejores patrones de diseño para asegurar la integridad y escalabilidad de los datos.',
                technologies:[
                    { name: 'MySQL', badge: '{{ asset('img/badges/mysql.svg') }}', description: 'El pilar de los datos de mis proyectos web. Diseño esquemas relacionales desde cero, optimizo índices para acelerar búsquedas y lanzo consultas SQL crudas complejas para reportes internos.' },
                    { name: 'MariaDB', badge: '{{ asset('img/badges/mariadb.svg') }}', description: 'La alternativa de código abierto y altísimo rendimiento que suelo montar cuando configuro mis propios servidores Linux, dándome total tranquilidad en la gestión de miles de registros.' },
                    { name: 'Firebase', badge: '{{ asset('img/badges/firebase.svg') }}', description: 'He usado mucho Firebase en proyectos de desarrollo móvil como en la red social que desarrollé: "Platorama". Además utilizo su base de datos NoSQL para sincronización en tiempo real, autenticación de usuarios y envíos masivos de notificaciones Push.' },
                    { name: 'SQLite', badge: '{{ asset('img/badges/sqlite.svg') }}', description: 'Mi comodín ligero. Lo utilizo para el almacenamiento local persistente en mis apps Android (para que funcionen offline) y para ejecutar baterías de testing ultrarrápidas en Laravel.' },
                    { name: 'phpMyAdmin', badge: '{{ asset('img/badges/phpmyadmin.svg') }}', description: 'La herramienta visual clásica a la que recurro en entornos de hosting compartido para hacer volcados rápidos de datos o gestionar privilegios de usuarios directamente en producción.' },
                    { name: 'HeidiSQL', badge: '{{ asset('img/badges/heidisql.svg') }}', description: 'El cliente SQL que abro cada día en mi equipo. Me permite conectarme remotamente a las bases de datos de mis clientes para lanzar scripts de mantenimiento o hacer migraciones masivas.' }
                ]
            },
            infra: {
                title: 'Infraestructura & DevOps',
                image: '{{ asset('img/skills/infra.svg') }}',
                icon: 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2',
                color: 'text-orange-600 dark:text-orange-400',
                bg: 'bg-orange-50 dark:bg-orange-900/30',
                description: 'No solo escribo código, también lo pongo en producción. Publico las aplicaciones, gestiono los servidores, el control de versiones y el posicionamiento en motores de búsqueda (SEO).',
                technologies:[
                    { name: 'Docker', badge: '{{ asset('img/badges/docker.svg') }}', description: 'Lo uso para acabar con el problema de "en mi máquina funciona" cuando pretendo compartir el proyecto o migrarlo a un servidor. Containerizando con entornos como Sail, garantizo que el código se comporte exactamente igual en mi PC que en el servidor.' },
                    { name: 'Nginx', badge: '{{ asset('img/badges/nginx.svg') }}', description: 'El motor de mis servidores VPS, esta web y la mayoría de webs que he hecho las hosteo en mi servidor privado con Nginx. Lo configuro como proxy inverso para despachar aplicaciones web y soportar grandes picos de concurrencia de forma supereficiente.' },
                    { name: 'Apache', badge: '{{ asset('img/badges/apache.svg') }}', description: 'Aunque actualmente prefiera usar Nginx sobre Apache por ser más moderno, veloz y optimizado, he usado mucho Apache en mi tiempo desarrollando en "Al Rescate" usando XAMPP y aprecio que todavía tiene algunas ventajas como servidor, especialmente para contenido dinámico y complejo.' },
                    { name: 'Git', badge: '{{ asset('img/badges/git.svg') }}', description: 'Es la herramienta que más uso pues es fundamental en cualquier proyecto de desarrollo de software: Me permite trabajar con ramas estructuradas, experimentar sin romper nada y contar con puntos de guardado.' },
                    { name: 'GitHub', badge: '{{ asset('img/badges/github.svg') }}', description: 'El hogar de mi código. Además de mis repositorios Git en la nube, lo utilizo para establecer flujos de trabajo profesionales donde puedo trabajar con otros desarrolladores, automatizar los despliegues a producción (CI/CD) o participar en proyectos públicos.' },
                    { name: 'Postman', badge: '{{ asset('img/badges/postman.svg') }}', description: 'Mi banco de pruebas en proyectos web. Antes de escribir una sola línea en el frontend, lo uso para estresar y validar mis APIs, asegurándome de que cada endpoint responda con la data exacta.' },
                    { name: 'Bash', badge: '{{ asset('img/badges/bash.svg') }}', description: 'Paso gran parte de mi tiempo conectado a servidores Linux por SSH a través de Bash. En la terminal, actualizo dependencias, administro el contenido o ejecuto mis propios scripts para automatizar rutinas pesadas, como los sistemas de copias de seguridad.' },
                    { name: 'FileZilla', badge: '{{ asset('img/badges/filezilla.svg') }}', description: 'Mi herramienta SFTP: Aunque gestionar servidores por Bash suele ser suficiente, a menudo uso Filezilla para conectarme de forma rápida por SFTP a servidores para comprobarlos o administrar el contenido de forma rápida si no se trata de muchos archivos (En cuyo caso preferiría subir un .zip y descomprimirlo con bash).' }
                ]
            },
            arquitectura: {
                title: 'Arquitectura y Patrones',
                image: '{{ asset('img/skills/arquitectura.svg') }}',
                icon: 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                color: 'text-purple-600 dark:text-purple-400',
                bg: 'bg-purple-50 dark:bg-purple-900/30',
                description: 'La diferencia entre un código que "funciona" y uno "profesional". Me tomo en serio estudiar y aplicar principios de ingeniería para crear software escalable y libre de deuda técnica.',
                technologies:[
                    { name: 'Clean Architecture', badge: '{{ asset('img/badges/clean-architecture.svg') }}', description: 'Me permite tener código separado por responsabilidades y escalable. Aislando el núcleo del negocio de la infraestructura consigo que cambiar de base de datos o framework en el futuro no implique reescribir toda la aplicación.' },
                    { name: 'SOLID Principles', badge: '{{ asset('img/badges/solid-principles.svg') }}', description: 'Considero que son principios básicos que todo programador debe conocer para un buen código. Aplicar estos principios permite escribir un código modular y testeable, que no se convierta en una pesadilla cuando haya que hacerle mantenimiento años después.' },
                    { name: 'Design Patterns', badge: '{{ asset('img/badges/design-patterns.svg') }}', description: 'No reinvento la rueda. Ante problemas de diseño recurrentes, aplico patrones probados (Observer, Factory, Repository, Singleton) para que mis soluciones sean elegantes y entendibles por otros.' },
                    { name: 'MVVM', badge: '{{ asset('img/badges/mvvm.svg') }}', description: 'La arquitectura que estructura mis apps móviles modernas como "Platorama". Desacoplar la interfaz gráfica de la lógica de negocio me ha permitido tener interfaces reactivas, predecibles y fáciles de probar.' },
                    { name: 'REST APIs', badge: '{{ asset('img/badges/rest-apis.svg') }}', description: 'Es como comunico mis sistemas. Me aseguro de diseñar APIs sin estado y sumamente lógicas, utilizando los verbos HTTP correctos, tokens JWT y códigos de estado semánticos en cada respuesta.' }
                ]
            }
        },
        
        _lastFocused: null,

        openModal(skillKey) {
            document.documentElement.classList.add('skills-modal-open');
            document.body.classList.add('skills-modal-open');
            this.activeSkill = this.skillsData[skillKey];
            this.showTechDetails = false;
            this.activeTech = null;
            this.modalOpen = true;
            // Gestión de foco: guardar origen y mover el foco al diálogo
            this._lastFocused = document.activeElement;
            this.$nextTick(() => {
                document.querySelector('.skills-modal-overlay [aria-label="Cerrar detalle"]')?.focus();
            });
        },
        closeModal() {
            this.modalOpen = false;
            this.showTechDetails = false;
            setTimeout(() => {
                this.activeSkill = null;
                this.activeTech = null;
            }, 500); // Espera a que termine la animación css
            document.documentElement.classList.remove('skills-modal-open');
            document.body.classList.remove('skills-modal-open');
            // Devolver el foco a la tarjeta que abrió el modal
            if (this._lastFocused?.focus) this._lastFocused.focus();
        },
        openTech(tech) {
            // Si hace click en la misma que ya está abierta, la cierra
            if (this.activeTech === tech) {
                this.closeTech();
            } else {
                this.activeTech = tech;
                this.showTechDetails = true;
            }
        },
        closeTech() {
            this.showTechDetails = false;
            setTimeout(() => this.activeTech = null, 400);
        }
    }))
})
</script>

@endpush
