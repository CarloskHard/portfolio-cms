<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>500 | Error del servidor</title>
    <meta name="description" content="Ha ocurrido un error interno. Estamos al tanto del problema.">
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
            50%       { transform: translate(20px, -15px) scale(1.06); }
        }
        @keyframes blob-drift-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(-15px, 10px) scale(1.04); }
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }
        .error-card  { animation: error-in 560ms cubic-bezier(0.22, 1, 0.36, 1) both; }
        .blob-1      { animation: blob-drift 9s ease-in-out infinite; }
        .blob-2      { animation: blob-drift-2 11s ease-in-out infinite 1s; }
        .pulse-dot   { animation: pulse-dot 2s ease-in-out infinite; }
        @media (prefers-reduced-motion: reduce) {
            .error-card, .blob-1, .blob-2, .pulse-dot { animation: none; }
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <main class="relative isolate flex min-h-screen items-center justify-center overflow-hidden px-6 py-16 sm:px-8">

        {{-- Background blobs --}}
        <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
            <div class="blob-1 absolute left-1/3 top-16 h-80 w-80 -translate-x-1/2 rounded-full bg-orange-500/15 blur-3xl dark:bg-orange-400/10"></div>
            <div class="blob-2 absolute bottom-0 right-0 h-72 w-72 rounded-full bg-red-400/10 blur-3xl dark:bg-red-500/10"></div>
            <div class="absolute left-0 top-1/2 h-64 w-64 rounded-full bg-amber-400/10 blur-3xl dark:bg-amber-500/8"></div>
        </div>

        <section class="error-card relative w-full max-w-xl overflow-hidden rounded-3xl border border-gray-200/70 bg-white/80 p-8 shadow-2xl shadow-gray-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/40 sm:p-10">

            {{-- Watermark code --}}
            <span class="pointer-events-none absolute -right-4 -top-3 select-none text-[8rem] font-black leading-none tracking-tighter text-gray-900/[0.04] dark:text-white/[0.05]" aria-hidden="true">500</span>

            {{-- Badge --}}
            <p class="inline-flex items-center gap-2 rounded-full border border-orange-200 bg-orange-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.14em] text-orange-600 dark:border-orange-400/20 dark:bg-orange-400/10 dark:text-orange-300">
                <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-orange-500 dark:bg-orange-400"></span>
                Error 500
            </p>

            <h1 class="mt-6 text-balance text-4xl font-semibold tracking-tight text-gray-950 dark:text-white sm:text-5xl">
                Algo salió mal.
            </h1>

            <p class="mt-4 text-pretty text-base leading-relaxed text-gray-600 dark:text-gray-300">
                El servidor ha encontrado un problema inesperado. Ya estamos al tanto. Vuelve al inicio o inténtalo de nuevo en unos momentos.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="/"
                   class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    Ir al inicio
                </a>
                <button onclick="window.location.reload()"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-gray-200 bg-transparent px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                    Reintentar
                </button>
            </div>
        </section>
    </main>
</body>
</html>
