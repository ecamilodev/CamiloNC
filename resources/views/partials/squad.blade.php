<section id="squad" class="section">
    <div class="container">
        <header class="section__header">
            <span class="section__eyebrow">◈ Squad</span>
            <h2 class="section__title">La Ganga</h2>
            <div class="section__divider" aria-hidden="true"></div>
            <p class="section__lead">Con los que siempre juego y caemos.</p>
        </header>

        @php
            $friends = [
                ['nick' => 'LORDDAMD',      'riot_id' => 'LORDDAMD',      'tag' => 'LAN'],
                ['nick' => 'EliLopez',      'riot_id' => 'elilopez',       'tag' => 'LAN'],
                ['nick' => 'xNoMercyx',     'riot_id' => 'xNoMercyx',      'tag' => '5117'],
                ['nick' => 'BRILLITOSH',    'riot_id' => 'BRlLLITOSH',     'tag' => 'PEDRO'],
                ['nick' => 'D4vidSG',       'riot_id' => 'D4vidSG',        'tag' => 'LAN'],
                ['nick' => 'Dark8Sider',    'riot_id' => 'Dark8Sider',     'tag' => 'LAN'],
                ['nick' => 'DarkFox',       'riot_id' => 'DarkFox',        'tag' => 'NGW'],
                ['nick' => 'Kaoz Locked',   'riot_id' => 'Kaoz Locked',    'tag' => '4151'],
                ['nick' => 'MR20 La perla', 'riot_id' => 'MR20 La perla',  'tag' => 'LAN'],
                ['nick' => 'Orca4K',        'riot_id' => 'Orca4K',         'tag' => 'MAR'],
            ];
        @endphp

        <div class="squad">
            @foreach ($friends as $index => $f)
                <div class="friend" data-riot-id="{{ $f['riot_id'] }}" data-riot-tag="{{ $f['tag'] }}" id="friend-{{ $index }}">
                    <div class="friend__avatar" id="friend-avatar-{{ $index }}">
                        <span class="friend__avatar-letter">{{ substr($f['nick'], 0, 1) }}</span>
                        <span class="friend__dot friend__dot--offline" id="friend-dot-{{ $index }}"></span>
                    </div>
                    <div class="friend__info">
                        <div class="friend__nick">{{ $f['nick'] }}</div>
                        <div class="friend__status" id="friend-status-{{ $index }}">Offline</div>
                        <div class="friend__rank" id="friend-rank-{{ $index }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
