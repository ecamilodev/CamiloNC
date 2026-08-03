<section id="squad" class="section">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Party</span>
            <h2 class="section__title">Mi escuadrón</h2>
            <div class="section__divider" aria-hidden="true"></div>
            <p class="section__lead">Con los que siempre juego.</p>
        </header>

        <div class="squad">
            @foreach ([
                ['nick' => 'ZedMain',   'status' => 'En partida', 'state' => 'ingame'],
                ['nick' => 'ElParcero', 'status' => 'En línea',   'state' => 'online'],
                ['nick' => 'SrKapi',    'status' => 'En línea',   'state' => 'online'],
                ['nick' => 'NicoUWU',   'status' => 'En línea',   'state' => 'online'],
                ['nick' => 'JotaPe',    'status' => 'En partida', 'state' => 'ingame'],
                ['nick' => 'Luciernaga','status' => 'En stream',  'state' => 'streaming'],
            ] as $f)
                <div class="friend">
                    <div class="friend__avatar">
                        {{-- Placeholder: reemplaza por <img src="{{ asset('images/friends/'.strtolower($f['nick']).'.jpg') }}" alt="{{ $f['nick'] }}" loading="lazy" decoding="async"> --}}
                        <span>{{ substr($f['nick'], 0, 1) }}</span>
                        <span class="friend__dot friend__dot--{{ $f['state'] }}"></span>
                    </div>
                    <div class="friend__info">
                        <div class="friend__nick">{{ $f['nick'] }}</div>
                        <div class="friend__status friend__status--{{ $f['state'] }}">{{ $f['status'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="squad__actions">
            <a href="#" class="btn btn--ghost">Ver todos los amigos</a>
        </div>
    </div>
</section>
