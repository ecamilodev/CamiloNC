<section id="games" class="section">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Biblioteca</span>
            <h2 class="section__title">Juegos favoritos</h2>
            <div class="section__divider" aria-hidden="true"></div>
        </header>

        {{-- Fallback estático: se muestra hasta que steam-games.js (si la API responde)
             reemplaza el contenido con los juegos reales de Steam. --}}
        <div class="games-list" id="games-list">
            @foreach ([
                ['name' => 'League of Legends', 'desc' => 'Mi hogar competitivo. MOBA por excelencia.', 'hours' => '7.843h', 'img' => 'game-lol-wide.jpg'],
                ['name' => 'Dead by Daylight', 'desc' => 'Terror asimétrico. Sobrevivir o cazar, no hay medias tintas.', 'hours' => '620h', 'img' => 'game-dbd-wide.jpg'],
                ['name' => 'Minecraft', 'desc' => 'Construir, explorar, sobrevivir. El clásico eterno.', 'hours' => '830h', 'img' => 'game-mc-wide.jpg'],
                ['name' => 'Halo', 'desc' => 'FPS de culto. Master Chief siempre presente.', 'hours' => '410h', 'img' => 'game-halo-wide.jpg'],
                ['name' => 'Project Zomboid', 'desc' => 'Supervivencia zombie hardcore. Cada decisión cuenta.', 'hours' => '320h', 'img' => 'game-zomboid-wide.jpg'],
            ] as $g)
                <article class="game-row">
                    <div class="game-row__thumb">
                        {{-- Placeholder: reemplaza por <img src="{{ asset('images/'.$g['img']) }}" alt="{{ $g['name'] }}" loading="lazy" decoding="async"> --}}
                        <div class="game-row__placeholder"><span>{{ $g['img'] }}</span></div>
                    </div>
                    <div class="game-row__body">
                        <h3 class="game-row__name">{{ $g['name'] }}</h3>
                        <p class="game-row__desc">{{ $g['desc'] }}</p>
                    </div>
                    <div class="game-row__meta">
                        <div class="game-row__hours">{{ $g['hours'] }}</div>
                        <div class="game-row__meta-label">jugadas</div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
