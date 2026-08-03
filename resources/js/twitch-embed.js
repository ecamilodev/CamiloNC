/**
 * Inyecta el iframe de Twitch solo cuando el usuario se acerca a la sección
 * stream (200px antes de que sea visible), en vez de cargarlo de entrada —
 * es pesado y era el principal causante del LCP alto.
 */
function initTwitchEmbed() {
    const container = document.getElementById('twitch-embed');
    if (!container) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const channel = container.dataset.channel;
                const parent = container.dataset.parent;
                const iframe = document.createElement('iframe');
                iframe.src = `https://player.twitch.tv/?channel=${channel}&parent=${parent}&muted=true`;
                iframe.width = '100%';
                iframe.height = '100%';
                iframe.allowFullscreen = true;
                iframe.title = 'Stream de Twitch de Camilo_nc';
                iframe.style.cssText = 'position:absolute;inset:0;border:none;';
                container.innerHTML = '';
                container.appendChild(iframe);
                observer.unobserve(container);
            }
        });
    }, { rootMargin: '200px' });

    observer.observe(container);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTwitchEmbed);
} else {
    initTwitchEmbed();
}
