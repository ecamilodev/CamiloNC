<section id="music" class="section section--dark">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Playlist</span>
            <h2 class="section__title">Mi banda sonora</h2>
            <div class="section__divider" aria-hidden="true"></div>
            <p class="section__lead">
                La música que me acompaña mientras juego, programo y hago stream.
            </p>
        </header>

        <div class="playlist-grid">
            @foreach ([
                ['emoji' => '🎮', 'name' => 'Ranked Grind',      'desc' => 'Música para jugar ranked.',           'id' => 'PLACEHOLDER_PLAYLIST_ID_1'],
                ['emoji' => '⚔️', 'name' => 'Focus Mode',        'desc' => 'Música épica para concentrarse.',     'id' => 'PLACEHOLDER_PLAYLIST_ID_2'],
                ['emoji' => '💻', 'name' => 'Coding Session',    'desc' => 'Música para programar.',              'id' => 'PLACEHOLDER_PLAYLIST_ID_3'],
                ['emoji' => '🌙', 'name' => 'Late Night Gaming', 'desc' => 'Música para jugar de noche.',         'id' => 'PLACEHOLDER_PLAYLIST_ID_4'],
            ] as $p)
                <article class="playlist-card">
                    <div class="playlist-card__header">
                        <span class="playlist-card__emoji" aria-hidden="true">{{ $p['emoji'] }}</span>
                        <div>
                            <h3 class="playlist-card__name">{{ $p['name'] }}</h3>
                            <p class="playlist-card__desc">{{ $p['desc'] }}</p>
                        </div>
                    </div>

                    {{--
                        Cuando quieras habilitar el reproductor real, reemplaza el placeholder por:
                        <iframe
                            src="https://open.spotify.com/embed/playlist/{{ $p['id'] }}?utm_source=generator&theme=0"
                            width="100%" height="152" frameborder="0"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture"
                            loading="lazy"></iframe>
                    --}}
                    <div class="playlist-card__player">
                        <span>Spotify embed · playlist {{ $p['id'] }}</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
