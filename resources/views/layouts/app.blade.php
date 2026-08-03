<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0a0612">
    <meta name="description" content="Camilo_nc — Gamer, streamer y desarrollador. Bienvenido a mi mundo.">

    <title>@yield('title', 'Camilo_nc · Bienvenido a mi mundo')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link rel="preload" as="image" href="{{ asset('images/Hero.jpg') }}">

    {{-- Vite compilará resources/css/app.css y resources/js/app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- Campo de partículas de fondo (puro CSS/JS, ligero) --}}
    <div class="particle-field" aria-hidden="true">
        <div class="particle-layer" id="particle-layer"></div>
        {{-- DESACTIVADO: optimización rendimiento --}}
        {{-- <div class="fog-layer"></div> --}}
        {{-- DESACTIVADO: optimización rendimiento --}}
        {{-- <div class="beam"></div> --}}
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Marca la sección activa al hacer scroll (diferido a "load" para no competir por el hilo principal durante la carga inicial) --}}
    <script>
        window.addEventListener('load', () => {
            const links = document.querySelectorAll('.nav-link[data-target]');
            const sections = Array.from(links)
                .map(a => document.getElementById(a.dataset.target))
                .filter(Boolean);

            const obs = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        links.forEach(l => l.classList.remove('is-active'));
                        const active = document.querySelector(`.nav-link[data-target="${e.target.id}"]`);
                        if (active) active.classList.add('is-active');
                    }
                });
            }, { threshold: 0.3 });

            sections.forEach(s => obs.observe(s));
        });
    </script>
</body>
</html>
