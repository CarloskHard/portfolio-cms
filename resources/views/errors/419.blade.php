<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>419 | Sesión expirada</title>
    <meta name="description" content="La sesión ha expirado. Por favor, vuelve atrás e inténtalo de nuevo.">
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
            50%       { transform: translate(18px, -10px) scale(1.05); }
        }
        @keyframes blob-drift-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(-10px, 12px) scale(1.04); }
        }
        .error-card { animation: error-in 560ms cubic-bezier(0.22, 1, 0.36, 1) both; }
        .blob-1     { animation: blob-drift 9s ease-in-out infinite; }
        .blob-2     { animation: blob-drift-2 11s ease-in-out infinite 2s; }
        @media (prefers-reduced-motion: reduce) {
            .error-card, .blob-1, .blob-2 { animation: none; }
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <main class="relative isolate flex min-h-screen items-center justify-center overflow-hidden px-6 py-16 sm:px-8">

        {{-- Background blobs --}}
        <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
            <div class="blob-1 absolute left-1/2 top-20 h-72 w-72 -translate-x-1/2 rounded-full bg-sky-400/15 blur-3xl dark:bg-sky-400/10"></div>
            <div class="blob-2 absolute bottom-0 right-0 h-64 w-64 rounded-full bg-blue-400/10 blur-3xl dark:bg-blue-500/10"></div>
            <div class="absolute left-0 top-1/2 h-64 w-64 rounded-full bg-indigo-400/8 blur-3xl dark:bg-indigo-500/8"></div>
        </div>

        <section class="error-card relative w-full max-w-xl overflow-hidden rounded-3xl border border-gray-200/70 bg-white/80 p-8 shadow-2xl shadow-gray-200/50 backdrop-blur-xl dark:border-white/10 dark:bg-white/5 dark:shadow-black/40 sm:p-10">

            {{-- Watermark code --}}
            <span class="pointer-events-none absolute -right-4 -top-3 select-none text-[8rem] font-black leading-none tracking-tighter text-gray-900/[0.04] dark:text-white/[0.05]" aria-hidden="true">419</span>

            {{-- Badge --}}
            <p class="inline-flex items-center gap-2 rounded-full border border-sky-200 bg-sky-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.14em] text-sky-700 dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-300">
                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Sesión expirada
            </p>

            <h1 class="mt-6 text-balance text-4xl font-semibold tracking-tight text-gray-950 dark:text-white sm:text-5xl">
                La sesión ha caducado.
            </h1>

            <p class="mt-4 text-pretty text-base leading-relaxed text-gray-600 dark:text-gray-300">
                Por seguridad, el formulario que intentabas enviar ha expirado. Vuelve atrás y envíalo de nuevo — tus datos no se han perdido.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <button onclick="history.length > 1 ? history.back() : (window.location.href = '/')"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Volver atrás
                </button>
                <a href="/"
                   class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-transparent px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/10">
                    Ir al inicio
                </a>
            </div>
        </section>
    </main>
</body>
</html>
