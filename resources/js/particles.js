/**
 * Partículas mágicas flotantes — CSS puro animado por keyframes.
 * Genera un número fijo que sube en bucle. Sin dependencias.
 * Respeta prefers-reduced-motion: si está activo, no genera nada.
 * Reactivadas (opción B) con conteo reducido y sin box-shadow por partícula
 * para bajar el costo de GPU; en mobile pequeño (<480px) no se generan.
 */
function initParticles() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const layer = document.getElementById('particle-layer');
    if (!layer) return;

    const isSmallMobile = window.matchMedia('(max-width: 479px)').matches;
    const isMobile = window.matchMedia('(max-width: 767px)').matches;
    const COUNT = isSmallMobile ? 0 : (isMobile ? 5 : 10);
    if (COUNT === 0) return;

    const sizes = ['particle--sm', '', 'particle--lg'];
    const golds = 6; // aprox 1 de cada 6 será dorada

    for (let i = 0; i < COUNT; i++) {
        const p = document.createElement('span');
        p.className = 'particle ' + sizes[Math.floor(Math.random() * sizes.length)];
        if (i % golds === 0) p.classList.add('particle--gold');

        // Posición horizontal aleatoria
        p.style.left = Math.random() * 100 + '%';

        // Duración entre 12s y 26s
        const duration = 12 + Math.random() * 14;
        p.style.animationDuration = duration + 's';

        // Delay inicial aleatorio para que no arranquen a la vez
        p.style.animationDelay = -(Math.random() * duration) + 's';

        // Desviación horizontal (variable CSS leída por el keyframe)
        const drift = (Math.random() - 0.5) * 120; // -60px a +60px
        p.style.setProperty('--drift', drift + 'px');

        layer.appendChild(p);
    }

    // El campo de partículas es "position: fixed" a pantalla completa, así que
    // nunca sale del viewport por scroll (un IntersectionObserver siempre lo
    // vería visible). La señal real de "no visible" aquí es la pestaña en
    // segundo plano, así que usamos la Page Visibility API para pausarlas.
    document.addEventListener('visibilitychange', () => {
        layer.classList.toggle('is-paused', document.hidden);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initParticles);
} else {
    initParticles();
}
