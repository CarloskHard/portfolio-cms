@props(['steps'])

@once
    <style>
        .web-dev-process__grid {
            --process-line-duration: 3.25s;
            position: relative;
        }

        @keyframes web-dev-process-step-enter {
            from {
                opacity: 0;
                transform: translateX(-1.25rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes web-dev-process-line-reveal {
            to {
                clip-path: inset(0 0 0 0);
            }
        }

        @keyframes web-dev-process-line-glow {
            0%,
            100% {
                filter: drop-shadow(0 0 2px rgba(129, 140, 248, 0.35)) drop-shadow(0 0 6px rgba(129, 140, 248, 0.18));
            }

            50% {
                filter: drop-shadow(0 0 5px rgba(129, 140, 248, 0.85)) drop-shadow(0 0 14px rgba(99, 102, 241, 0.45));
            }
        }

        .web-dev-process__step {
            opacity: 0;
            animation: web-dev-process-step-enter 0.55s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
            animation-play-state: paused;
        }

        .web-dev-process__grid.is-visible .web-dev-process__step {
            animation-play-state: running;
        }

        .web-dev-process__step:nth-child(2) {
            animation-delay: var(--process-step-1-delay, 0s);
        }

        .web-dev-process__step:nth-child(3) {
            animation-delay: var(--process-step-2-delay, 0.55s);
        }

        .web-dev-process__step:nth-child(4) {
            animation-delay: var(--process-step-3-delay, 0.95s);
        }

        .web-dev-process__step:nth-child(5) {
            animation-delay: var(--process-step-4-delay, 1.35s);
        }

        @media (min-width: 1024px) {
            .web-dev-process__grid {
                --process-step-1-delay: 0s;
                --process-step-2-delay: calc(var(--process-line-duration) * 0.32);
                --process-step-3-delay: calc(var(--process-line-duration) * 0.64);
                --process-step-4-delay: calc(var(--process-line-duration) - 0.05s);
            }

            .web-dev-process__track {
                position: absolute;
                top: calc(1.5rem - 1px);
                left: calc(12.5% + 2.25rem);
                right: calc(12.5% + 2.25rem);
                height: 2px;
                z-index: 0;
                pointer-events: none;
                overflow: hidden;
            }

            .web-dev-process__track::before {
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                background-image: repeating-linear-gradient(
                    to right,
                    rgba(99, 102, 241, 0.72) 0 10px,
                    transparent 10px 18px
                );
                background-size: 18px 2px;
                clip-path: inset(0 100% 0 0);
                animation:
                    web-dev-process-line-reveal var(--process-line-duration) linear forwards,
                    web-dev-process-line-glow 3s ease-in-out calc(var(--process-line-duration) + 0.2s) infinite;
                animation-play-state: paused, paused;
            }

            .web-dev-process__grid.is-visible .web-dev-process__track::before {
                animation-play-state: running, running;
            }

            html.dark .web-dev-process__track::before {
                background-image: repeating-linear-gradient(
                    to right,
                    rgba(148, 163, 184, 0.42) 0 10px,
                    transparent 10px 18px
                );
            }

            .web-dev-process__step {
                z-index: 1;
            }

            .web-dev-process__icon {
                position: relative;
                z-index: 1;
            }

            html.dark .web-dev-process__icon {
                background-color: color-mix(in srgb, rgb(99 102 241) 15%, rgb(2 6 23));
            }
        }

        @media (max-width: 1023px) {
            .web-dev-process__step:nth-child(2) {
                animation-delay: 0.15s;
            }

            .web-dev-process__step:nth-child(3) {
                animation-delay: 0.55s;
            }

            .web-dev-process__step:nth-child(4) {
                animation-delay: 0.95s;
            }

            .web-dev-process__step:nth-child(5) {
                animation-delay: 1.35s;
            }

            .web-dev-process__step:not(:last-child)::after {
                content: '';
                position: absolute;
                left: calc(1.5rem - 1px);
                top: 3.5rem;
                width: 2px;
                height: calc(100% - 1.75rem);
                background-image: repeating-linear-gradient(
                    to bottom,
                    rgba(99, 102, 241, 0.55) 0 10px,
                    transparent 10px 18px
                );
                clip-path: inset(0 0 100% 0);
                animation: web-dev-process-line-reveal 0.8s ease-out forwards;
                animation-play-state: paused;
            }

            .web-dev-process__grid.is-visible .web-dev-process__step:not(:last-child)::after {
                animation-play-state: running;
            }

            html.dark .web-dev-process__step:not(:last-child)::after {
                background-image: repeating-linear-gradient(
                    to bottom,
                    rgba(148, 163, 184, 0.42) 0 10px,
                    transparent 10px 18px
                );
            }

            .web-dev-process__step:nth-child(2)::after {
                animation-delay: 0.45s;
            }

            .web-dev-process__step:nth-child(3)::after {
                animation-delay: 0.85s;
            }

            .web-dev-process__step:nth-child(4)::after {
                animation-delay: 1.25s;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .web-dev-process__step,
            .web-dev-process__grid.is-visible .web-dev-process__step {
                opacity: 1;
                transform: none;
                animation: none;
            }

            .web-dev-process__track::before,
            .web-dev-process__grid.is-visible .web-dev-process__track::before,
            .web-dev-process__step::after,
            .web-dev-process__grid.is-visible .web-dev-process__step:not(:last-child)::after {
                animation: none;
                clip-path: none;
                filter: none;
            }
        }
    </style>

    <script>
        (function () {
            var reveal = function () {
                document.querySelectorAll('.web-dev-process__grid').forEach(function (grid) {
                    grid.classList.add('is-visible');
                });
            };

            if (typeof IntersectionObserver === 'undefined' || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.addEventListener('DOMContentLoaded', reveal);
                return;
            }

            var observer = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.25, rootMargin: '0px 0px -10% 0px' });

            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.web-dev-process__grid').forEach(function (grid) {
                    observer.observe(grid);
                });
            });
        })();
    </script>
@endonce

<div {{ $attributes->merge(['class' => 'web-dev-process__grid mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 text-left lg:max-w-none lg:grid-cols-4 lg:text-center']) }}>
    <div class="web-dev-process__track hidden lg:block" aria-hidden="true"></div>

    @foreach ($steps as $step)
        <div class="web-dev-process__step relative flex items-start gap-4 lg:flex-col lg:items-center lg:gap-0">
            <div class="web-dev-process__icon flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/15 dark:text-indigo-300">
                {!! $step['icon'] !!}
            </div>
            <div class="pt-1 lg:mt-4 lg:pt-0">
                <p class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">{{ $step['title'] }}</p>
                <p class="mt-1 text-sm leading-relaxed text-gray-600 dark:text-gray-300 lg:mt-2">{{ $step['description'] }}</p>
            </div>
        </div>
    @endforeach
</div>
