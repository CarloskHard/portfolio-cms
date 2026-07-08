/* HOME hero: scroll reveal (data-reveal) + shader WebGL.
   Extraido del inline de public/home.blade.php (modulo Vite).
   El componente Alpine de skills sigue inline: debe registrarse
   antes de Alpine.start() (app.js). */

(function () {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let revealIo = null;

    function bindScrollReveals() {
        if (reduceMotion.matches) {
            document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
            return;
        }
        if (!revealIo) {
            revealIo = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        entry.target.classList.add('is-visible');
                        revealIo.unobserve(entry.target);
                    });
                },
                { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.06 }
            );
        }
        document.querySelectorAll('[data-reveal]:not([data-reveal-bound])').forEach((el) => {
            el.setAttribute('data-reveal-bound', '');
            const ms = el.dataset.revealDelay;
            if (ms !== undefined && ms !== '') {
                el.style.setProperty('--hr-reveal-delay', `${ms}ms`);
            }
            revealIo.observe(el);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        bindScrollReveals();
        requestAnimationFrame(() => {
            bindScrollReveals();
            requestAnimationFrame(bindScrollReveals);
        });
    });
    window.addEventListener('load', bindScrollReveals);
})();

/* ────────────────────────────────────────────────────────────────────
   1. WebGL shader — dark diagonal-flow contained in .hr-hero card
   ──────────────────────────────────────────────────────────────────── */
(function initHeroShader() {
  const canvas = document.getElementById('hr-shader-canvas');
  if (!canvas) return;
  const gl = canvas.getContext('webgl', { premultipliedAlpha: false, antialias: true, alpha: true });
  if (!gl) return;
  gl.disable(gl.DEPTH_TEST);
  gl.enable(gl.BLEND);
  gl.blendFunc(gl.SRC_ALPHA, gl.ONE_MINUS_SRC_ALPHA);

  function resize() {
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    const rect = canvas.getBoundingClientRect();
    const w = Math.max(1, Math.floor(rect.width * dpr));
    const h = Math.max(1, Math.floor(rect.height * dpr));
    if (canvas.width !== w || canvas.height !== h) { canvas.width = w; canvas.height = h; }
    gl.viewport(0, 0, w, h);
  }
  resize();
  window.addEventListener('resize', resize);
  if (window.ResizeObserver) new ResizeObserver(resize).observe(canvas);

  const vsSrc = `attribute vec2 a; void main(){ gl_Position = vec4(a, 0., 1.); }`;
  const fsSrc = `
    precision highp float;
    uniform vec2  u_res;
    uniform float u_time;
    uniform float u_intensity;
    uniform vec3  u_cA;
    uniform vec3  u_cB;
    uniform float u_fluidMix;
    uniform float u_pastel;
    uniform float u_vignFloor;
    float noise(vec2 p) { return fract(sin(dot(p, vec2(12.9898, 78.233))) * 43758.5453); }
    void main(){
      vec2 uv = gl_FragCoord.xy / u_res.xy;
      float ratio = u_res.x / u_res.y;
      vec2 p = uv; p.x *= ratio;
      float t = u_time * 0.18;
      vec2 shift = p;
      for (float i = 1.0; i < 4.0; i++) {
        shift.x += 0.42 / i * sin(i * 1.7 * p.y + t * 1.05);
        shift.y += 0.36 / i * cos(i * 1.7 * p.x + t * 0.95);
      }
      float diagonal = shift.x + shift.y * ratio;
      /* Bounded phase drift keeps motion alive without pushing band off-canvas */
      float sweep = sin(t * 0.72) * (0.32 * max(ratio, 0.35));
      float wobble = 0.22 * sin(p.y * 2.6 + t * 1.15)
                   + 0.16 * cos(p.x * 2.2 - t * 0.88)
                   + 0.09 * sin((p.x + p.y * 0.7) * 3.4 + t * 0.42);
      float target = ratio * 1.02 + wobble;
      float band = abs((diagonal + sweep) - target);
      band += 0.055 * (noise(p * 6.2 + vec2(t * 0.12, -t * 0.08)) - 0.5);
      /*
        band scales ~linearly with aspect ratio (width/height). Fixed smoothstep edges
        blow up on tall phones (tiny ratio) and invert smoothstep had edge0 > edge1 (undefined).
        Normalizing makes stripe width consistent across viewports.
      */
      float bandN = band / max(ratio, 0.04);
      /* Narrow core, soft falloff (valid smoothstep: low < high) */
      float mask = 1.0 - smoothstep(0.06, 0.74, bandN);
      float mixer    = smoothstep(0.2, 0.8, uv.x + sin(t * 0.5) * 0.2);
      vec3  bandCol  = mix(u_cA, u_cB, mixer);
      vec3  fluid    = bandCol * u_fluidMix;
      vec3  ice      = vec3(0.99, 0.99, 1.0);
      vec3  pastelCore = mix(ice, bandCol, 0.62);
      pastelCore = mix(pastelCore, vec3(1.0), 0.12);
      vec3  color = mix(fluid, pastelCore, u_pastel);
      float vign     = smoothstep(1.1, 0.3, length(uv - vec2(0.35, 0.5)));
      color *= mix(u_vignFloor, 1.0, vign);
      /*
        Peak opacity must exceed legacy “opaque mix × u_intensity”: same fluid over page bg disappears
        if α stays ~0.35. Boost coverage; pow softens halo without killing the stripe core.
      */
      float stripeAmp = clamp(mask * u_intensity * 3.05, 0.0, 1.0);
      float blendAlpha = clamp(pow(stripeAmp, 0.76), 0.0, 1.0);
      float g = (noise(uv + fract(u_time)) - 0.5) * 0.025;
      color += g * mix(1.0, 0.45, u_pastel) * stripeAmp;
      gl_FragColor = vec4(color, blendAlpha);
    }
  `;
  function mkS(type, src) {
    const s = gl.createShader(type);
    gl.shaderSource(s, src); gl.compileShader(s);
    return s;
  }
  const prog = gl.createProgram();
  gl.attachShader(prog, mkS(gl.VERTEX_SHADER, vsSrc));
  gl.attachShader(prog, mkS(gl.FRAGMENT_SHADER, fsSrc));
  gl.linkProgram(prog); gl.useProgram(prog);
  const buf = gl.createBuffer();
  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1,1,-1,-1,1,-1,1,1,-1,1,1]), gl.STATIC_DRAW);
  const aLoc = gl.getAttribLocation(prog, 'a');
  gl.enableVertexAttribArray(aLoc);
  gl.vertexAttribPointer(aLoc, 2, gl.FLOAT, false, 0, 0);
  const uRes = gl.getUniformLocation(prog, 'u_res');
  const uTime = gl.getUniformLocation(prog, 'u_time');
  const uIntensity = gl.getUniformLocation(prog, 'u_intensity');
  const uCA = gl.getUniformLocation(prog, 'u_cA');
  const uCB = gl.getUniformLocation(prog, 'u_cB');
  const uFluidMix = gl.getUniformLocation(prog, 'u_fluidMix');
  const uPastel = gl.getUniformLocation(prog, 'u_pastel');
  const uVignFloor = gl.getUniformLocation(prog, 'u_vignFloor');
  function parseHexRgbNorm(hex) {
    let h = hex.trim().replace(/^#/, '');
    if (h.length === 3) h = h.split('').map((c) => c + c).join('');
    const n = parseInt(h, 16);
    if (!Number.isFinite(n) || h.length !== 6) return [0.39, 0.4, 0.59];
    return [(n >> 16) / 255, ((n >> 8) & 255) / 255, (n & 255) / 255];
  }
  function parseFluidMix() {
    const v = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--hr-shader-fluid-mix').trim());
    return Number.isFinite(v) ? v : 0.55;
  }
  function parsePastelUniform() {
    const v = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--hr-shader-pastel').trim());
    return Number.isFinite(v) ? Math.min(1, Math.max(0, v)) : 0;
  }
  function parseVignFloor() {
    const v = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--hr-shader-vign-floor').trim());
    return Number.isFinite(v) ? v : 0.85;
  }
  const t0 = performance.now();
  /* Start from a later visual phase so first frame looks "settled" */
  const shaderStartOffsetSec = 50.0;
  let active = true;
  function frame() {
    if (!active) return;
    const t = ((performance.now() - t0) / 1000 + shaderStartOffsetSec) * 0.5;
    const root = document.documentElement;
    const intensity = parseFloat(getComputedStyle(root).getPropertyValue('--hr-shader-intensity').trim()) || 0.22;
    const style = getComputedStyle(root);
    const [ar, ag, ab] = parseHexRgbNorm(style.getPropertyValue('--hr-accent-soft'));
    const [cr, cg, cb] = parseHexRgbNorm(style.getPropertyValue('--hr-accent'));
    gl.clearColor(0, 0, 0, 0);
    gl.clear(gl.COLOR_BUFFER_BIT);
    gl.uniform2f(uRes, canvas.width, canvas.height);
    gl.uniform1f(uTime, t);
    gl.uniform1f(uIntensity, intensity);
    gl.uniform3f(uCA, ar, ag, ab);
    gl.uniform3f(uCB, cr, cg, cb);
    gl.uniform1f(uFluidMix, parseFluidMix());
    gl.uniform1f(uPastel, parsePastelUniform());
    gl.uniform1f(uVignFloor, parseVignFloor());
    gl.drawArrays(gl.TRIANGLES, 0, 6);
    requestAnimationFrame(frame);
  }
  frame();
  if (window.IntersectionObserver) {
    new IntersectionObserver(([e]) => { active = e.isIntersecting; if (active) frame(); }, { threshold: 0 }).observe(canvas);
  }
})();
