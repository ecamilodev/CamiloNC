<section id="hero" class="hero">
    <div class="hero__bg" aria-hidden="true">
        <img class="hero__bg-img" src="{{ asset('images/Hero.jpg') }}" alt="" fetchpriority="high" decoding="async">
        <div class="hero__bg-vignette"></div>
    </div>

    <div class="hero__inner">
        <div class="hero__content">
            <div class="hero__eyebrow">
                <svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true">
                    <path fill="currentColor" d="M12 2 4 6v6c0 5 3.5 9.5 8 10 4.5-.5 8-5 8-10V6l-8-4z"/>
                </svg>
                <span>MAIN TOP / ADC</span>
            </div>

            <h1 class="hero__title">
                <span class="hero__title-line hero__title-line--white">BIENVENIDO</span>
                <span class="hero__title-line hero__title-line--purple">A MI MUNDO</span>
            </h1>

            <p class="hero__subtitle">
                Gamer, streamer y desarrollador. Me apasiona competir, mejorar cada día
                y compartir buenos momentos con mi comunidad.
            </p>

            <div class="hero__actions">
                <a href="https://www.twitch.tv/camilo_nc" target="_blank" rel="noopener noreferrer" class="btn btn--primary">
                    <x-icon name="twitch" :size="18" />
                    Ver stream en Twitch
                </a>
                <div class="hero__follow">
                    <span>Sígueme en</span>
                    <div class="socials socials--inline">
                        <a href="https://www.twitch.tv/camilo_nc" target="_blank" rel="noopener noreferrer" aria-label="Twitch"><x-icon name="twitch" :size="20" /></a>
                        <a href="https://x.com/CamiloNC23" target="_blank" rel="noopener noreferrer" aria-label="X / Twitter"><x-icon name="x" :size="18" /></a>
                        <a href="https://www.instagram.com/camilo_nc_/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><x-icon name="instagram" :size="20" /></a>
                        <a href="https://www.youtube.com/@CamiloNC23" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><x-icon name="youtube" :size="20" /></a>
                    </div>
                </div>
            </div>
        </div>

        <aside class="hero__side">
            <blockquote class="quote-card">
                <div class="quote-card__mark">"</div>
                <p class="quote-card__text">No es solo un juego,<br>es mi perdición también.</p>
                <cite class="quote-card__author">— Camilo_nc</cite>
            </blockquote>

            @include('partials.profile-card')
        </aside>
    </div>
</section>
