/* Cabeceras decorativas SVG para los modales de skills (sustituyen fotos stock hot-linkeadas) */
const fs = require('fs');
const path = require('path');

const OUT = process.argv[2];
fs.mkdirSync(OUT, { recursive: true });

// [archivo, color base, color secundario, icono (path 24x24, stroke)]
const headers = [
  ['web.svg', '#4f46e5', '#818cf8', 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'],
  ['movil.svg', '#16a34a', '#4ade80', 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
  ['ecommerce.svg', '#db2777', '#f472b6', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
  ['bbdd.svg', '#2563eb', '#60a5fa', 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4'],
  ['infra.svg', '#ea580c', '#fb923c', 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2'],
  ['arquitectura.svg', '#9333ea', '#c084fc', 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
];

for (const [file, c1, c2, icon] of headers) {
  const id = file.replace('.svg', '');
  const svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 320" role="img" aria-hidden="true">
<defs>
<linearGradient id="g-${id}" x1="0" y1="0" x2="1" y2="1">
<stop offset="0" stop-color="${c1}"/><stop offset="1" stop-color="${c2}"/>
</linearGradient>
<pattern id="p-${id}" width="34" height="34" patternUnits="userSpaceOnUse">
<path d="M34 0H0v34" fill="none" stroke="rgba(255,255,255,0.14)" stroke-width="1"/>
</pattern>
<radialGradient id="v-${id}" cx="0.85" cy="0.1" r="1">
<stop offset="0" stop-color="rgba(255,255,255,0.28)"/><stop offset="0.6" stop-color="rgba(255,255,255,0)"/>
</radialGradient>
</defs>
<rect width="800" height="320" fill="url(#g-${id})"/>
<rect width="800" height="320" fill="url(#p-${id})"/>
<rect width="800" height="320" fill="url(#v-${id})"/>
<circle cx="120" cy="260" r="150" fill="rgba(255,255,255,0.06)"/>
<circle cx="700" cy="60" r="110" fill="rgba(255,255,255,0.08)"/>
<g transform="translate(316,76) scale(7)" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
<path d="${icon}"/>
</g>
</svg>`;
  fs.writeFileSync(path.join(OUT, file), svg);
}
console.log('Generadas', headers.length, 'cabeceras en', OUT);
