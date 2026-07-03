<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Mantenimiento | Volvemos pronto</title>
    <meta name="description" content="El sitio está temporalmente fuera de servicio por tareas de mantenimiento.">
    <meta name="robots" content="noindex,nofollow">

    @vite(['resources/css/app.css'])

    <script>
        if (localStorage['color-theme'] === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        @keyframes error-in {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes blob-drift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(15px, -12px) scale(1.05); }
        }
        @keyframes blob-drift-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(-12px, 8px) scale(1.04); }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        .error-card  { animation: error-in 560ms cubic-bezier(0.22, 1, 0.36, 1) both; }
        .blob-1      { animation: blob-drift 10s ease-in-out infinite; }
        .blob-2      { animation: blob-drift-2 12s ease-in-out infinite 1.5s; }
        .icon-spin   { animation: spin-slow 8s linear infinite; }
        @media (prefers-reduced-motion: reduce) {
            .error-card, .blob-1, .blob-2, .icon-spin { animation: none; }
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <main class="relative isolate flex min-h-screen items-center justify-center overflow-hidden px-6 py-16 sm:px-8">

        {{-- Background blobs --}}
        <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
            <div class="blob-1 absolute left-1/2 top-16 h-80 w-80 -translate-x-1/2 rounded-full bg-yellow-400/15 blur-3xl dark:bg-yellow-300/10"></div>
            <div class="blob-2 absolute bottom-0 left-0 h-72 w-72 rounded-full bg-amber-500/10 blur-3xl dark:bg-amber-400/8"></div>
            <div class="absolute right-0 top-1/3 h-64 w-64 rounded-full bg-orange-400/8 blur-3xl dark:bg-orange-500/8"></div>
        </div>

        <section class="error-card relative w-full max-w-xl overflow-hidden rounded-3xl border border-gray-200/70 bg-white/80 p-8 shadow-2xl shadow-gray-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/40 sm:p-10">

            {{-- Watermark code --}}
            <span class="pointer-events-none absolute -right-4 -top-3 select-none text-[8rem] font-black leading-none tracking-tighter text-gray-900/[0.04] dark:text-white/[0.05]" aria-hidden="true">503</span>

            {{-- Badge --}}
            <p class="inline-flex items-center gap-2 rounded-full border border-yellow-200 bg-yellow-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.14em] text-yellow-700 dark:border-yellow-400/20 dark:bg-yellow-400/10 dark:text-yellow-300">
                <svg class="icon-spin h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                Mantenimiento
            </p>

            <h1 class="mt-6 text-balance text-4xl font-semibold tracking-tight text-gray-950 dark:text-white sm:text-5xl">
                Volvemos pronto.
            </h1>

            <p class="mt-4 text-pretty text-base leading-relaxed text-gray-600 dark:text-gray-300">
                El sitio está temporalmente fuera de servicio por tareas de mantenimiento. Debería tardar poco — vuelve en unos minutos.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button onclick="window.location.reload()"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-yellow-500 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                    Recargar página
                </button>
            </div>
        </section>
    </main>
</body>
</html>
