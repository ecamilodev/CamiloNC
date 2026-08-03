<header class="site-header">
    <div class="site-header__inner">
        <a href="#hero" class="brand" aria-label="Ir al inicio">
            <span class="brand__logo" aria-hidden="true">
                {{-- Logo SVG hecho a mano — gran letra C con corona ornamental --}}
                <svg viewBox="0 0 64 64" width="48" height="48" role="img" aria-label="Logo Camilo_nc">
                    <defs>
                        <linearGradient id="brandGrad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#f0c674"/>
                            <stop offset="100%" stop-color="#c8a04c"/>
                        </linearGradient>
                    </defs>
                    <path d="M12 8 L32 4 L52 8 L54 14 L48 12 L32 8 L16 12 L10 14 Z"
                          fill="url(#brandGrad)" opacity="0.9"/>
                    <text x="32" y="46" text-anchor="middle"
                          font-family="Georgia, serif" font-size="38" font-weight="700"
                          fill="url(#brandGrad)">C</text>
                    <path d="M8 56 L32 60 L56 56" stroke="url(#brandGrad)"
                          stroke-width="1.2" fill="none" opacity="0.7"/>
                </svg>
            </span>
            <span class="brand__text">
                <span class="brand__name">CAMILO_NC</span>
                <span class="brand__tag">INVOCADOR</span>
            </span>
        </a>

        <nav class="site-nav" aria-label="Navegación principal">
            <a class="nav-link is-active" data-target="hero" href="#hero">Inicio</a>
            <a class="nav-link" data-target="stream" href="#stream">Stream</a>
            <a class="nav-link" data-target="about" href="#about">Sobre mí</a>
            <a class="nav-link" data-target="league" href="#league">League</a>
            <a class="nav-link" data-target="games" href="#games">Juegos</a>
            <a class="nav-link" data-target="music" href="#music">Música</a>
            <a class="nav-link" data-target="squad" href="#squad">Amigos</a>
            <a class="nav-link" data-target="highlights" href="#highlights">Highlights</a>
        </nav>

        <div class="site-header__actions">
            <div class="socials socials--compact">
                <a href="https://www.twitch.tv/camilo_nc" target="_blank" rel="noopener noreferrer" class="social" aria-label="Twitch" title="Twitch">
                    <x-icon name="twitch" :size="18" />
                </a>
                <a href="https://open.spotify.com/user/70pcqc86padfxdhfk5yrx7mgp?si=4ecaea43966e41b3" target="_blank" rel="noopener noreferrer" class="social" aria-label="Spotify" title="Spotify">
                    <x-icon name="spotify" :size="18" />
                </a>
                <a href="https://discord.gg/eBrUckcpYy" target="_blank" rel="noopener noreferrer" class="social" aria-label="Discord" title="Discord">
                    <x-icon name="discord" :size="18" />
                </a>
                <a href="https://www.instagram.com/camilo_nc_/" target="_blank" rel="noopener noreferrer" class="social" aria-label="Instagram" title="Instagram">
                    <x-icon name="instagram" :size="18" />
                </a>
                <a href="https://www.youtube.com/@CamiloNC23" target="_blank" rel="noopener noreferrer" class="social" aria-label="YouTube" title="YouTube">
                    <x-icon name="youtube" :size="18" />
                </a>
                <a href="https://x.com/CamiloNC23" target="_blank" rel="noopener noreferrer" class="social" aria-label="X / Twitter" title="X">
                    <x-icon name="x" :size="16" />
                </a>
            </div>

            <a href="#stream" class="live-badge">
                <span class="live-badge__dot" aria-hidden="true"></span>
                EN VIVO AHORA
            </a>
        </div>
    </div>
</header>
