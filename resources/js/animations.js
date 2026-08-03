/**
 * Animaciones GSAP del sitio — entrada del hero, reveals al hacer scroll,
 * parallax sutil y detalles de hover. Todo vive aquí para tener un solo
 * punto de referencia. Se apaga por completo si el usuario prefiere
 * movimiento reducido.
 */
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// DESACTIVADO: optimización rendimiento
// Versión original completa (con x/y/scale, parallax del hero, hover GSAP de
// champion-card y el listener de scroll del header) queda comentada abajo.
// Para reactivarla: comenta la función initAnimations() simplificada que
// sigue después de este bloque y descomenta esta.
/*
function initAnimations() {
    if (prefersReducedMotion) return;

    // Hero: timeline de entrada orquestada.
    const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    heroTl
        .from('.hero__eyebrow', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            delay: 0.3,
        })
        .from('.hero__title-line--white', {
            opacity: 0,
            x: -60,
            duration: 0.8,
        }, '-=0.3')
        .from('.hero__title-line--purple', {
            opacity: 0,
            x: -80,
            duration: 0.8,
        }, '-=0.5')
        .from('.hero__subtitle', {
            opacity: 0,
            y: 20,
            duration: 0.6,
        }, '-=0.4')
        .from('.hero__actions', {
            opacity: 0,
            y: 20,
            duration: 0.5,
        }, '-=0.3')
        .from('.quote-card', {
            opacity: 0,
            x: 40,
            duration: 0.7,
        }, '-=0.6')
        .from('.profile-card', {
            opacity: 0,
            y: 40,
            duration: 0.7,
        }, '-=0.4');

    // Stream: paneles con stagger al entrar en viewport.
    gsap.from('.grid--stream .panel', {
        scrollTrigger: {
            trigger: '.grid--stream',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 50,
        duration: 0.7,
        stagger: 0.15,
        ease: 'power2.out',
    });

    // Títulos, eyebrows y dividers de cada sección: reveal al entrar.
    gsap.utils.toArray('.section__title').forEach((title) => {
        gsap.from(title, {
            scrollTrigger: {
                trigger: title,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            y: 30,
            duration: 0.8,
            ease: 'power3.out',
        });
    });

    gsap.utils.toArray('.section__eyebrow').forEach((eyebrow) => {
        gsap.from(eyebrow, {
            scrollTrigger: {
                trigger: eyebrow,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            y: 30,
            duration: 0.8,
            delay: 0.1,
            ease: 'power3.out',
        });
    });

    gsap.utils.toArray('.section__divider').forEach((divider) => {
        gsap.from(divider, {
            scrollTrigger: {
                trigger: divider,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            y: 30,
            duration: 0.8,
            delay: 0.2,
            ease: 'power3.out',
        });
    });

    // League: champion-cards con escala + fade desde abajo.
    gsap.from('.champion-card', {
        scrollTrigger: {
            trigger: '.champion-grid',
            start: 'top 75%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 60,
        scale: 0.95,
        duration: 0.8,
        stagger: 0.2,
        ease: 'back.out(1.2)',
    });

    // League: resumen (lol-summary) uno por uno.
    gsap.from('.lol-summary__item', {
        scrollTrigger: {
            trigger: '.lol-summary',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 30,
        duration: 0.5,
        stagger: 0.12,
        ease: 'power2.out',
    });

    // Games: filas desde la izquierda.
    gsap.from('.game-row', {
        scrollTrigger: {
            trigger: '.games-list',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        x: -40,
        duration: 0.6,
        stagger: 0.12,
        ease: 'power2.out',
    });

    // Música: playlist-cards con fade + y.
    gsap.from('.playlist-card', {
        scrollTrigger: {
            trigger: '.playlist-grid',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 40,
        duration: 0.6,
        stagger: 0.15,
        ease: 'power2.out',
    });

    // Squad: amigos con stagger rápido.
    gsap.from('.friend', {
        scrollTrigger: {
            trigger: '.squad',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        scale: 0.97,
        duration: 0.4,
        stagger: 0.08,
        ease: 'power2.out',
    });

    // Highlights: clips con fade + escala.
    gsap.from('.highlight', {
        scrollTrigger: {
            trigger: '.highlights',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 40,
        scale: 0.96,
        duration: 0.6,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Sobre mí: reveal suave de la about-card.
    gsap.from('.about-card', {
        scrollTrigger: {
            trigger: '.about-card',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 50,
        duration: 1,
        ease: 'power3.out',
    });

    // Footer: focus-win (FOCUS / IMPROVE / WIN + #NC).
    gsap.from('.focus-win', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 30,
        duration: 0.8,
        ease: 'power3.out',
    });

    gsap.from('.focus-win__words span', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        x: -30,
        duration: 0.5,
        stagger: 0.15,
        ease: 'power2.out',
    });

    gsap.from('.focus-win__mark', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        scale: 0.8,
        duration: 0.8,
        ease: 'back.out(1.5)',
    });

    // Hero: parallax sutil del fondo.
    gsap.to('.hero__bg', {
        scrollTrigger: {
            trigger: '.hero',
            start: 'top top',
            end: 'bottom top',
            scrub: 1,
        },
        y: 150,
        ease: 'none',
    });

    // Header: más opaco al bajar, transparente cerca del top.
    ScrollTrigger.create({
        start: 'top -100',
        onUpdate: (self) => {
            const header = document.querySelector('.site-header');
            if (!header) return;

            if (self.direction === 1 && self.scroll() > 100) {
                header.style.background = 'rgba(6, 3, 15, 0.95)';
            } else if (self.scroll() <= 100) {
                header.style.background = '';
            }
        },
    });

    // League: glow adicional de hover sobre las champion-card (el CSS existente queda como fallback).
    document.querySelectorAll('.champion-card').forEach((card) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                boxShadow: '0 24px 60px -20px rgba(168, 85, 247, 0.6), 0 0 40px rgba(168, 85, 247, 0.3)',
                duration: 0.3,
                ease: 'power2.out',
            });
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                boxShadow: '',
                duration: 0.4,
                ease: 'power2.inOut',
            });
        });
    });
}
*/

// DESACTIVADO: optimización rendimiento — opción A (solo fade-in, sin y/x/scale).
// Se deja comentada como referencia; la versión activa (opción B) está debajo.
/*
function initAnimations() {
    if (prefersReducedMotion) return;

    // Hero: timeline de entrada, solo fade-in.
    const heroTl = gsap.timeline({ defaults: { ease: 'power2.out' } });

    heroTl
        .from('.hero__eyebrow', { opacity: 0, duration: 0.4 })
        .from('.hero__title-line--white', { opacity: 0, duration: 0.4 }, '-=0.25')
        .from('.hero__title-line--purple', { opacity: 0, duration: 0.4 }, '-=0.25')
        .from('.hero__subtitle', { opacity: 0, duration: 0.4 }, '-=0.25')
        .from('.hero__actions', { opacity: 0, duration: 0.4 }, '-=0.25')
        .from('.quote-card', { opacity: 0, duration: 0.4 }, '-=0.25')
        .from('.profile-card', { opacity: 0, duration: 0.4 }, '-=0.25');

    // Stream: paneles, fade-in.
    gsap.from('.grid--stream .panel', {
        scrollTrigger: {
            trigger: '.grid--stream',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Títulos, eyebrows y dividers de cada sección: fade-in.
    gsap.utils.toArray('.section__title').forEach((title) => {
        gsap.from(title, {
            scrollTrigger: {
                trigger: title,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out',
        });
    });

    gsap.utils.toArray('.section__eyebrow').forEach((eyebrow) => {
        gsap.from(eyebrow, {
            scrollTrigger: {
                trigger: eyebrow,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out',
        });
    });

    gsap.utils.toArray('.section__divider').forEach((divider) => {
        gsap.from(divider, {
            scrollTrigger: {
                trigger: divider,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out',
        });
    });

    // League: champion-cards, fade-in.
    gsap.from('.champion-card', {
        scrollTrigger: {
            trigger: '.champion-grid',
            start: 'top 75%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // League: resumen (lol-summary), fade-in.
    gsap.from('.lol-summary__item', {
        scrollTrigger: {
            trigger: '.lol-summary',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Games: filas, fade-in.
    gsap.from('.game-row', {
        scrollTrigger: {
            trigger: '.games-list',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Música: playlist-cards, fade-in.
    gsap.from('.playlist-card', {
        scrollTrigger: {
            trigger: '.playlist-grid',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Squad: amigos, fade-in.
    gsap.from('.friend', {
        scrollTrigger: {
            trigger: '.squad',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Highlights: clips, fade-in.
    gsap.from('.highlight', {
        scrollTrigger: {
            trigger: '.highlights',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Sobre mí: fade-in de la about-card.
    gsap.from('.about-card', {
        scrollTrigger: {
            trigger: '.about-card',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Footer: focus-win (FOCUS / IMPROVE / WIN + #NC), fade-in.
    gsap.from('.focus-win', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    gsap.from('.focus-win__words span', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    gsap.from('.focus-win__mark', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // DESACTIVADO: optimización rendimiento — parallax del hero background
    // gsap.to('.hero__bg', {
    //     scrollTrigger: {
    //         trigger: '.hero',
    //         start: 'top top',
    //         end: 'bottom top',
    //         scrub: 1,
    //     },
    //     y: 150,
    //     ease: 'none',
    // });

    // DESACTIVADO: optimización rendimiento — header más opaco al bajar
    // ScrollTrigger.create({
    //     start: 'top -100',
    //     onUpdate: (self) => {
    //         const header = document.querySelector('.site-header');
    //         if (!header) return;
    //
    //         if (self.direction === 1 && self.scroll() > 100) {
    //             header.style.background = 'rgba(6, 3, 15, 0.95)';
    //         } else if (self.scroll() <= 100) {
    //             header.style.background = '';
    //         }
    //     },
    // });

    // DESACTIVADO: optimización rendimiento — hover GSAP de champion-card (queda solo el hover CSS existente)
    // document.querySelectorAll('.champion-card').forEach((card) => {
    //     card.addEventListener('mouseenter', () => {
    //         gsap.to(card, {
    //             boxShadow: '0 24px 60px -20px rgba(168, 85, 247, 0.6), 0 0 40px rgba(168, 85, 247, 0.3)',
    //             duration: 0.3,
    //             ease: 'power2.out',
    //         });
    //     });
    //     card.addEventListener('mouseleave', () => {
    //         gsap.to(card, {
    //             boxShadow: '',
    //             duration: 0.4,
    //             ease: 'power2.inOut',
    //         });
    //     });
    // });
}
*/

// Versión activa (opción B): fade-in + translate vertical suave, sin x, sin scale,
// sin back.out. Parallax del hero, header-scroll y hover GSAP siguen desactivados.
function initAnimations() {
    if (prefersReducedMotion) return;

    // Hero: timeline de entrada, fade-in + y suave.
    const heroTl = gsap.timeline({ defaults: { ease: 'power2.out', duration: 0.5 } });

    heroTl
        .from('.hero__eyebrow', { opacity: 0, y: 15 })
        .from('.hero__title-line--white', { opacity: 0, y: 20 }, '-=0.3')
        .from('.hero__title-line--purple', { opacity: 0, y: 20 }, '-=0.35')
        .from('.hero__subtitle', { opacity: 0, y: 15 }, '-=0.3')
        .from('.hero__actions', { opacity: 0, y: 15 }, '-=0.25')
        .from('.quote-card', { opacity: 0, y: 20 }, '-=0.3')
        .from('.profile-card', { opacity: 0, y: 20 }, '-=0.25');

    // Stream: paneles, fade-in + y.
    gsap.from('.grid--stream .panel', {
        scrollTrigger: {
            trigger: '.grid--stream',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Títulos de sección: fade-in + y.
    gsap.utils.toArray('.section__title').forEach((title) => {
        gsap.from(title, {
            scrollTrigger: {
                trigger: title,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            y: 20,
            duration: 0.5,
            ease: 'power2.out',
        });
    });

    // Eyebrows: fade-in + y.
    gsap.utils.toArray('.section__eyebrow').forEach((eyebrow) => {
        gsap.from(eyebrow, {
            scrollTrigger: {
                trigger: eyebrow,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
            opacity: 0,
            y: 15,
            duration: 0.4,
            ease: 'power2.out',
        });
    });

    // League: champion-cards, fade-in + y.
    gsap.from('.champion-card', {
        scrollTrigger: {
            trigger: '.champion-grid',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 30,
        duration: 0.6,
        stagger: 0.15,
        ease: 'power2.out',
    });

    // League: resumen (lol-summary), fade-in + y.
    gsap.from('.lol-summary__item', {
        scrollTrigger: {
            trigger: '.lol-summary',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 20,
        duration: 0.4,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Games: filas, fade-in + y.
    gsap.from('.game-row', {
        scrollTrigger: {
            trigger: '.games-list',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
    });

    // Música: playlist-cards, fade-in + y.
    gsap.from('.playlist-card', {
        scrollTrigger: {
            trigger: '.playlist-grid',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        duration: 0.5,
        stagger: 0.12,
        ease: 'power2.out',
    });

    // Squad: amigos, fade-in + y.
    gsap.from('.friend', {
        scrollTrigger: {
            trigger: '.squad',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 20,
        duration: 0.4,
        stagger: 0.07,
        ease: 'power2.out',
    });

    // Highlights: clips, fade-in + y.
    gsap.from('.highlight', {
        scrollTrigger: {
            trigger: '.highlights',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        duration: 0.5,
        stagger: 0.08,
        ease: 'power2.out',
    });

    // Sobre mí: fade-in + y de la about-card.
    gsap.from('.about-card', {
        scrollTrigger: {
            trigger: '.about-card',
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 30,
        duration: 0.6,
        ease: 'power2.out',
    });

    // Footer: focus-win (FOCUS / IMPROVE / WIN + #NC), fade-in + y.
    gsap.from('.focus-win', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 25,
        duration: 0.6,
        ease: 'power2.out',
    });

    gsap.from('.focus-win__words span', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 15,
        duration: 0.4,
        stagger: 0.1,
        ease: 'power2.out',
    });

    gsap.from('.focus-win__mark', {
        scrollTrigger: {
            trigger: '.focus-win',
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        duration: 0.5,
        ease: 'power2.out',
    });

    // DESACTIVADO: optimización rendimiento — parallax del hero background
    // gsap.to('.hero__bg', {
    //     scrollTrigger: {
    //         trigger: '.hero',
    //         start: 'top top',
    //         end: 'bottom top',
    //         scrub: 1,
    //     },
    //     y: 150,
    //     ease: 'none',
    // });

    // DESACTIVADO: optimización rendimiento — header más opaco al bajar
    // ScrollTrigger.create({
    //     start: 'top -100',
    //     onUpdate: (self) => {
    //         const header = document.querySelector('.site-header');
    //         if (!header) return;
    //
    //         if (self.direction === 1 && self.scroll() > 100) {
    //             header.style.background = 'rgba(6, 3, 15, 0.95)';
    //         } else if (self.scroll() <= 100) {
    //             header.style.background = '';
    //         }
    //     },
    // });

    // DESACTIVADO: optimización rendimiento — hover GSAP de champion-card (queda solo el hover CSS existente)
    // document.querySelectorAll('.champion-card').forEach((card) => {
    //     card.addEventListener('mouseenter', () => {
    //         gsap.to(card, {
    //             boxShadow: '0 24px 60px -20px rgba(168, 85, 247, 0.6), 0 0 40px rgba(168, 85, 247, 0.3)',
    //             duration: 0.3,
    //             ease: 'power2.out',
    //         });
    //     });
    //     card.addEventListener('mouseleave', () => {
    //         gsap.to(card, {
    //             boxShadow: '',
    //             duration: 0.4,
    //             ease: 'power2.inOut',
    //         });
    //     });
    // });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnimations);
} else {
    initAnimations();
}
