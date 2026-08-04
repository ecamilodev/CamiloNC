<section id="stream" class="section section--grid">
    <div class="container">
        <div class="grid grid--stream">
            {{-- STREAM EN DIRECTO --}}
            <div class="panel panel--stream">
                <div class="panel__header">
                    <h2 class="panel__title">
                        <span class="panel__title-icon">▶</span>
                        EN DIRECTO
                    </h2>
                    <span class="live-tag">
                        <span class="live-tag__dot"></span>
                        LIVE
                    </span>
                </div>

                <div class="stream-preview">
                    <!-- PRODUCCIÓN: cambia data-parent="localhost" por data-parent="tudominio.com" cuando subas a producción -->
                    <div class="stream-preview__embed" id="twitch-embed" data-channel="camilo_nc" data-parent="localhost">
                        <div class="stream-preview__placeholder">
                            <span>Cargando stream...</span>
                        </div>
                    </div>
                    <div class="stream-preview__overlay">
                        <div class="streamer">
                            <div class="streamer__avatar">
                                {{-- Placeholder avatar --}}
                                <span>C</span>
                            </div>
                            <div class="streamer__info">
                                <div class="streamer__name">
                                    Camilo_nc
                                    <svg viewBox="0 0 24 24" width="14" height="14" class="verified"><path fill="#a855f7" d="M12 2 4 5v6.1c0 5.1 3.4 9.8 8 10.9 4.6-1.1 8-5.8 8-10.9V5l-8-3zm-1.1 14.5-4-4 1.4-1.4 2.6 2.6 5.6-5.6 1.4 1.4-7 7z"/></svg>
                                </div>
                                <div class="streamer__game">Ranked chill, Tristana ADC ✈</div>
                                <div class="streamer__game streamer__game--dim">League of Legends</div>
                            </div>
                            <span class="live-tag live-tag--sm">
                                <span class="live-tag__dot"></span>
                                EN VIVO
                            </span>
                        </div>
                        <a href="https://www.twitch.tv/camilo_nc" target="_blank" rel="noopener noreferrer" class="btn btn--ghost btn--sm">Ir al canal</a>
                    </div>
                </div>
            </div>

            {{-- SOBRE MÍ RESUMEN --}}
            <div class="panel panel--about-mini">
                <h2 class="panel__title">
                    <span class="panel__title-icon">◈</span>
                    ¿QUIÉN SOY?
                </h2>
                <p class="panel__lead">
                    Soy Camilo, ingeniero de sistemas y amante de los videojuegos.
                    League of Legends es mi juego favorito (o eso creo), pero también
                    disfruto muchos otros.
                </p>
                <ul class="traits">
                    <li><span class="traits__mark">◆</span> Competitivo</li>
                    <li><span class="traits__mark">◆</span> Perfeccionista (o al menos lo intento)</li>
                    <li><span class="traits__mark">◆</span> Buen humor</li>
                    <li><span class="traits__mark">◆</span> Serio pero un tipazo</li>
                    <li><span class="traits__mark">◆</span> Siempre buscando mejorar</li>
                </ul>
            </div>

            {{-- MIS CAMPEONES --}}
            <div class="panel panel--champions">
                <div class="panel__header">
                    <h2 class="panel__title">
                        <span class="panel__title-icon">♛</span>
                        MIS CAMPEONES
                    </h2>
                    <span class="panel__eyebrow">MÁS JUGADOS</span>
                </div>

                <div class="champions">
                    @foreach ([
                        ['name' => 'TRISTANA', 'wr' => '64%', 'games' => '39'],
                        ['name' => "KAI'SA", 'wr' => '60%', 'games' => '25'],
                        ['name' => 'SETT', 'wr' => '62%', 'games' => '21'],
                    ] as $c)
                        <div class="champion">
                            <div class="champion__portrait">
                                {{-- Placeholder: reemplaza por <img src="images/champ-{{ strtolower($c['name']) }}.jpg" alt="{{ $c['name'] }}" loading="lazy" decoding="async"> --}}
                                <div class="champion__placeholder">{{ substr($c['name'], 0, 1) }}</div>
                            </div>
                            <div class="champion__name">{{ $c['name'] }}</div>
                            <div class="champion__wr">{{ $c['wr'] }} <span>WR</span></div>
                            <div class="champion__games">{{ $c['games'] }} partidas</div>
                        </div>
                    @endforeach
                </div>

                <a href="https://op.gg/es/lol/summoners/lan/El%20Jefe-313?queue_type=SOLORANKED" target="_blank" rel="noopener noreferrer" class="btn btn--ghost btn--block">Ver todos</a>
            </div>

            {{-- JUEGOS QUE DISFRUTO --}}
            <div class="panel panel--games-mini">
                <h2 class="panel__title">
                    <span class="panel__title-icon">▲</span>
                    JUEGOS QUE DISFRUTO
                </h2>

                <ul class="games-strip" id="games-strip">
                    @foreach ([
                        ['name' => 'League of Legends', 'img' => 'game-lol.jpg'],
                        ['name' => 'Minecraft', 'img' => 'game-minecraft.jpg'],
                        ['name' => 'Project Zomboid', 'img' => 'game-zomboid.jpg'],
                        ['name' => 'Dead by Daylight', 'img' => 'game-dbd.jpg'],
                    ] as $g)
                        <li class="games-strip__item">
                            <div class="games-strip__thumb">
                                {{-- Placeholder: reemplaza por <img src="{{ asset('images/'.$g['img']) }}" alt="{{ $g['name'] }}" loading="lazy" decoding="async"> --}}
                                <span>{{ $g['img'] }}</span>
                            </div>
                            <span class="games-strip__name">{{ $g['name'] }}</span>
                        </li>
                    @endforeach
                </ul>

                <a href="#games" class="btn btn--ghost btn--block">Ver más juegos</a>
            </div>
        </div>
    </div>
</section>
