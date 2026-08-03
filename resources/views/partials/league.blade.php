<section id="league" class="section section--dark">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Runaterra</span>
            <h2 class="section__title">Mi historia en League of Legends</h2>
            <div class="section__divider" aria-hidden="true"></div>
            <p class="section__lead">
                Inicié jugando en pandemia por curiosidad, jugando chill durante un buen tiempo
                y siendo bronce de corazón, pero últimamente he tratado de mejorar y se nota el
                avance... o eso dicen :v
            </p>
        </header>

        <div class="lol-summary">
            <div class="lol-summary__item">
                <div class="lol-summary__label">Rol principal</div>
                <div class="lol-summary__value">TOP</div>
            </div>
            <div class="lol-summary__item">
                <div class="lol-summary__label">Mejor temporada</div>
                <div class="lol-summary__value">S2026 Split 2</div>
            </div>
            <div class="lol-summary__item">
                <div class="lol-summary__label">Rango máximo</div>
                <div class="lol-summary__value">Platinum III</div>
            </div>
            <div class="lol-summary__item">
                <div class="lol-summary__label">Servidor</div>
                <div class="lol-summary__value">LAN</div>
            </div>
        </div>

        <div class="champion-grid">
            @foreach ([
                ['name' => 'Sett', 'mastery' => '7', 'wr' => '62%', 'games' => 21, 'role' => 'TOP / SUPP'],
                ['name' => 'Tristana', 'mastery' => '7', 'wr' => '64%', 'games' => 39, 'role' => 'ADC'],
                ['name' => "Kai'Sa", 'mastery' => '6', 'wr' => '60%', 'games' => 25, 'role' => 'ADC'],
            ] as $c)
                <article class="champion-card">
                    <div class="champion-card__portrait">
                        <img src="{{ asset('images/champ-'.strtolower(str_replace("'", '', $c['name'])).'-full.jpg') }}" alt="{{ $c['name'] }}" loading="lazy" decoding="async" width="720" height="900" style="width:100%;height:100%;object-fit:cover;">
                        <div class="champion-card__scrim"></div>
                    </div>

                    <div class="champion-card__body">
                        <div class="champion-card__role">{{ $c['role'] }}</div>
                        <h3 class="champion-card__name">{{ $c['name'] }}</h3>

                        <div class="champion-card__stats">
                            <div>
                                <div class="stat__label">Maestría</div>
                                <div class="stat__value stat__value--gold">M{{ $c['mastery'] }}</div>
                            </div>
                            <div>
                                <div class="stat__label">Winrate</div>
                                <div class="stat__value stat__value--win">{{ $c['wr'] }}</div>
                            </div>
                            <div>
                                <div class="stat__label">Partidas</div>
                                <div class="stat__value">{{ $c['games'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="champion-card__corner champion-card__corner--tl"></div>
                    <div class="champion-card__corner champion-card__corner--tr"></div>
                    <div class="champion-card__corner champion-card__corner--bl"></div>
                    <div class="champion-card__corner champion-card__corner--br"></div>
                </article>
            @endforeach
        </div>
    </div>
</section>
