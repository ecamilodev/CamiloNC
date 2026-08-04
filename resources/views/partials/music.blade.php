<section id="music" class="section section--dark">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Playlist</span>
            <h2 class="section__title">Mis Playlist</h2>
            <div class="section__divider" aria-hidden="true"></div>
            <p class="section__lead">
                La música que me acompaña mientras juego, programo y hago stream.
            </p>
        </header>

        @php
            use App\Services\SpotifyService;

            $playlists = [
                ['emoji' => '🎮', 'name' => 'Ranked Grind',    'desc' => 'Música para jugar ranked.',                             'id' => '629xJheAL2V3V3OFKTRMae'],
                ['emoji' => '⚔️', 'name' => 'Focus Mode',      'desc' => 'Música épica para concentrarse.',                       'id' => '4S3FI0F5ey9TzWNm4SBzL2'],
                ['emoji' => '💔', 'name' => 'Despecho',         'desc' => 'Corridos pa recordar a esa persona que más quisiste.',  'id' => '0hfwl95ALnulnsPfkziaZR'],
                ['emoji' => '🔥', 'name' => 'Feid & Desamor',   'desc' => 'Reggaetón de desamor pa los sentimientos.',             'id' => '29mrskuaFUXGBxFuMwFGlK'],
                ['emoji' => '🎸', 'name' => 'Algo Tranqui',     'desc' => 'Rock alternativo, nacional argentino e inglés.',        'id' => '72YbiEygAgQ07vcinD2lmy'],
            ];
        @endphp

        <div class="playlist-grid">
            @foreach ($playlists as $p)
                @php
                    $cover = SpotifyService::getPlaylistCover($p['id']);
                @endphp
                <a href="https://open.spotify.com/playlist/{{ $p['id'] }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="playlist-card">

                    <div class="playlist-card__cover">
                        @if ($cover)
                            <img src="{{ $cover }}"
                                 alt="{{ $p['name'] }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="playlist-card__img">
                        @else
                            <span class="playlist-card__emoji-large" aria-hidden="true">{{ $p['emoji'] }}</span>
                        @endif
                        <div class="playlist-card__play" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28">
                                <circle cx="12" cy="12" r="12" fill="#1db954"/>
                                <path d="M9.5 7.5v9l7-4.5z" fill="white"/>
                            </svg>
                        </div>
                    </div>

                    <div class="playlist-card__info">
                        <h3 class="playlist-card__name">{{ $p['name'] }}</h3>
                        <p class="playlist-card__desc">{{ $p['desc'] }}</p>
                    </div>

                    <div class="playlist-card__open">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm4.6 14.4c-.2.3-.5.4-.8.2-2.2-1.3-5-1.6-8.2-.9-.4.1-.7-.2-.8-.5-.1-.4.2-.7.5-.8 3.6-.8 6.7-.4 9.1 1 .3.2.4.6.2.9v.1zm1.2-2.6c-.2.4-.7.5-1.1.3-2.5-1.5-6.3-2-9.2-1.1-.4.1-.9-.1-1-.5-.1-.4.1-.9.5-1 3.4-1 7.6-.5 10.5 1.3.4.2.5.7.3 1zm.1-2.7c-3-1.8-8-2-10.9-1.1-.5.2-1.1-.1-1.2-.6-.2-.5.1-1.1.6-1.2 3.4-1 9-.8 12.4 1.3.5.3.6.9.3 1.4-.3.4-.9.5-1.2.2z"/></svg>
                        <span>Abrir en Spotify</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
