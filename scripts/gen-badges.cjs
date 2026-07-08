/* Genera badges SVG estilo shields "flat" con logos de simple-icons */
const fs = require('fs');
const path = require('path');
const si = require('simple-icons');

const OUT = process.argv[2];
fs.mkdirSync(OUT, { recursive: true });

// ancho aproximado de caracteres Verdana 11px (suficiente: usamos textLength para ajuste exacto)
function textWidth(s) {
  let w = 0;
  for (const ch of s) {
    if (/[A-Z]/.test(ch)) w += 7.6;
    else if (/[a-z0-9]/.test(ch)) w += 6.4;
    else if (ch === ' ') w += 3.9;
    else if (/[.,:;'|!Iil]/.test(ch)) w += 3.2;
    else if (/[+#/&]/.test(ch)) w += 7.0;
    else w += 6.4;
  }
  return Math.round(w);
}

function luminance(hex) {
  const n = parseInt(hex, 16);
  const r = (n >> 16) & 255, g = (n >> 8) & 255, b = n & 255;
  return (0.299 * r + 0.587 * g + 0.114 * b) / 255;
}

function findIcon(slug) {
  if (!slug) return null;
  const key = 'si' + slug.charAt(0).toUpperCase() + slug.slice(1);
  return si[key] || null;
}

function badge({ file, text, color, slug, logoColor }) {
  const icon = findIcon(slug);
  const tw = textWidth(text);
  const padL = 5, gap = 4, logoW = icon ? 14 : 0;
  const textX = padL + (icon ? logoW + gap : 0);
  const width = textX + tw + 6;
  const textColor = luminance(color) > 0.62 ? '#333' : '#fff';
  const lc = (logoColor === 'black') ? '#333' : '#fff';
  const logo = icon
    ? `<g transform="translate(${padL},3) scale(${14 / 24})"><path d="${icon.path}" fill="${lc}"/></g>`
    : '';
  const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${width}" height="20" role="img" aria-label="${text.replace(/&/g, '&amp;')}">
<linearGradient id="s" x2="0" y2="100%"><stop offset="0" stop-color="#bbb" stop-opacity=".1"/><stop offset="1" stop-opacity=".1"/></linearGradient>
<clipPath id="r"><rect width="${width}" height="20" rx="3" fill="#fff"/></clipPath>
<g clip-path="url(#r)"><rect width="${width}" height="20" fill="#${color}"/><rect width="${width}" height="20" fill="url(#s)"/></g>
${logo}
<g fill="${textColor}" text-anchor="start" font-family="Verdana,Geneva,DejaVu Sans,sans-serif" font-size="11">
<text x="${textX}" y="14" textLength="${tw}">${text.replace(/&/g, '&amp;')}</text>
</g>
</svg>`;
  fs.writeFileSync(path.join(OUT, file), svg);
  return { file, hasLogo: !!icon };
}

const badges = [
  { file: 'laravel.svg', text: 'Laravel', color: 'FF2D20', slug: 'laravel', logoColor: 'white' },
  { file: 'php.svg', text: 'PHP', color: '777BB4', slug: 'php', logoColor: 'white' },
  { file: 'javascript.svg', text: 'JavaScript', color: 'F7DF1E', slug: 'javascript', logoColor: 'black' },
  { file: 'tailwind-css.svg', text: 'Tailwind CSS', color: '38B2AC', slug: 'tailwindcss', logoColor: 'white' },
  { file: 'html5.svg', text: 'HTML5', color: 'E34F26', slug: 'html5', logoColor: 'white' },
  { file: 'css3.svg', text: 'CSS3', color: '1572B6', slug: 'css', logoColor: 'white' },
  { file: 'jquery.svg', text: 'jQuery', color: '0769AD', slug: 'jquery', logoColor: 'white' },
  { file: 'bootstrap.svg', text: 'Bootstrap', color: '7952B3', slug: 'bootstrap', logoColor: 'white' },
  { file: 'kotlin.svg', text: 'Kotlin', color: '7F52FF', slug: 'kotlin', logoColor: 'white' },
  { file: 'android-studio.svg', text: 'Android Studio', color: '3DDC84', slug: 'androidstudio', logoColor: 'white' },
  { file: 'cpp.svg', text: 'C++', color: '00599C', slug: 'cplusplus', logoColor: 'white' },
  { file: 'csharp.svg', text: 'C#', color: '239120', slug: 'dotnet', logoColor: 'white' },
  { file: 'unity.svg', text: 'Unity', color: '100000', slug: 'unity', logoColor: 'white' },
  { file: 'prestashop.svg', text: 'PrestaShop', color: 'DF0067', slug: 'prestashop', logoColor: 'white' },
  { file: 'dolibarr-erp.svg', text: 'Dolibarr ERP', color: '2980B9', slug: null },
  { file: 'stripe.svg', text: 'Stripe', color: '635BFF', slug: 'stripe', logoColor: 'white' },
  { file: 'laravel-cashier.svg', text: 'Laravel Cashier', color: 'FF2D20', slug: 'laravel', logoColor: 'white' },
  { file: 'mysql.svg', text: 'MySQL', color: '4479A1', slug: 'mysql', logoColor: 'white' },
  { file: 'mariadb.svg', text: 'MariaDB', color: '003545', slug: 'mariadb', logoColor: 'white' },
  { file: 'firebase.svg', text: 'Firebase', color: 'FFCA28', slug: 'firebase', logoColor: 'black' },
  { file: 'sqlite.svg', text: 'SQLite', color: '003B57', slug: 'sqlite', logoColor: 'white' },
  { file: 'phpmyadmin.svg', text: 'phpMyAdmin', color: '6C78AF', slug: 'phpmyadmin', logoColor: 'white' },
  { file: 'heidisql.svg', text: 'HeidiSQL', color: 'FFD43B', slug: null },
  { file: 'docker.svg', text: 'Docker', color: '2496ED', slug: 'docker', logoColor: 'white' },
  { file: 'nginx.svg', text: 'Nginx', color: '009639', slug: 'nginx', logoColor: 'white' },
  { file: 'apache.svg', text: 'Apache', color: 'D22128', slug: 'apache', logoColor: 'white' },
  { file: 'git.svg', text: 'Git', color: 'F05032', slug: 'git', logoColor: 'white' },
  { file: 'github.svg', text: 'GitHub', color: '181717', slug: 'github', logoColor: 'white' },
  { file: 'postman.svg', text: 'Postman', color: 'FF6C37', slug: 'postman', logoColor: 'white' },
  { file: 'bash.svg', text: 'Terminal/Bash', color: '4EAA25', slug: 'gnubash', logoColor: 'white' },
  { file: 'filezilla.svg', text: 'FileZilla', color: 'BF0000', slug: 'filezilla', logoColor: 'white' },
  { file: 'clean-architecture.svg', text: 'Clean Architecture', color: '607D8B', slug: null },
  { file: 'solid-principles.svg', text: 'SOLID Principles', color: '607D8B', slug: null },
  { file: 'design-patterns.svg', text: 'Design Patterns', color: '607D8B', slug: null },
  { file: 'mvvm.svg', text: 'MVVM', color: '607D8B', slug: null },
  { file: 'rest-apis.svg', text: 'REST APIs', color: '607D8B', slug: null },
];

const results = badges.map(badge);
const missingLogo = results.filter(r => !r.hasLogo).map(r => r.file);
console.log(`Generados ${results.length} badges en ${OUT}`);
console.log('Sin logo (esperado en genéricos):', missingLogo.join(', '));
