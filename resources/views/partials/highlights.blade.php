<section id="highlights" class="section section--dark">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Best of</span>
            <h2 class="section__title">Highlights</h2>
            <div class="section__divider" aria-hidden="true"></div>
        </header>

        <div class="highlights">
            @foreach ([
                ['title' => 'Pentakill con Tristana', 'tag' => 'PENTAKILL',  'img' => 'clip-1.jpg'],
                ['title' => 'Outplay 1v3 con Sett',   'tag' => 'OUTPLAY',    'img' => 'clip-2.jpg'],
                ['title' => 'Escape imposible en DBD','tag' => 'CLUTCH',     'img' => 'clip-3.jpg'],
                ['title' => 'Racha ranked S13',       'tag' => 'HIGHLIGHT',  'img' => 'clip-4.jpg'],
                ['title' => 'Momento troll con squad','tag' => 'FUNNY',      'img' => 'clip-5.jpg'],
                ['title' => 'Ace en team fight',      'tag' => 'TEAMFIGHT',  'img' => 'clip-6.jpg'],
            ] as $h)
                <a href="#" class="highlight">
                    <div class="highlight__thumb">
                        {{-- Placeholder: reemplaza por <img src="{{ asset('images/'.$h['img']) }}" alt="" loading="lazy" decoding="async"> --}}
                        <div class="highlight__placeholder"><span>{{ $h['img'] }}</span></div>
                        <span class="highlight__tag">{{ $h['tag'] }}</span>
                        <span class="highlight__play" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                    <div class="highlight__title">{{ $h['title'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
</section>
