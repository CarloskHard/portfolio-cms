<svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <!-- Pantalla -->
    <rect x="3" y="4" width="18" height="12" rx="2" ry="2"></rect>
    <!-- Teclado -->
    <line x1="2" y1="20" x2="22" y2="20"></line>
    
    <!-- Puntitos animados (Simulando escribir) -->
    <!-- Nota: Usamos fill-current para que tomen el color del texto -->
    <circle cx="8" cy="10" r="1" class="animate-pulse" style="animation-delay: 0ms; fill: currentColor; stroke: none;"></circle>
    <circle cx="12" cy="10" r="1" class="animate-pulse" style="animation-delay: 100ms; fill: currentColor; stroke: none;"></circle>
    <circle cx="16" cy="10" r="1" class="animate-pulse" style="animation-delay: 200ms; fill: currentColor; stroke: none;"></circle>
</svg>