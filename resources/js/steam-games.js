/**
 * Carga los juegos más jugados desde /api/steam/games (backend, que a su vez
 * llama a la Steam Web API) y reemplaza la lista estática de #games-list y
 * la tira #games-strip por datos reales. League of Legends no existe en
 * Steam, así que se antepone siempre como entrada manual con horas fijas.
 * Si el fetch falla o la API no devuelve nada, se dejan los juegos estáticos
 * del HTML tal cual (sin mostrar ningún error).
 */
const GAMES_ENDPOINT = '/api/steam/games';

const LOL_GAME = {
    isLol: true,
    name: 'League of Legends',
    hoursLabel: '7.843h',
};

function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value ?? '';
    return div.innerHTML;
}

function formatHours(hours) {
    return `${Number(hours ?? 0).toLocaleString('es-ES')}h`;
}

function gameRowHTML(game) {
    const name = escapeHtml(game.name);

    if (game.isLol) {
        return `
            <article class="game-row">
                <div class="game-row__thumb">
                    <div class="game-row__placeholder"><span>LoL</span></div>
                </div>
                <div class="game-row__body">
                    <h3 class="game-row__name">${name}</h3>
                </div>
                <div class="game-row__meta">
                    <div class="game-row__hours">${game.hoursLabel}</div>
                    <div class="game-row__meta-label">jugadas</div>
                </div>
            </article>
        `;
    }

    return `
        <article class="game-row">
            <div class="game-row__thumb">
                <img src="${game.header_url}" alt="${name}" loading="lazy" decoding="async"
                     style="width:100%;height:100%;object-fit:cover;border-radius:6px;">
            </div>
            <div class="game-row__body">
                <h3 class="game-row__name">${name}</h3>
            </div>
            <div class="game-row__meta">
                <div class="game-row__hours">${formatHours(game.playtime_hours)}</div>
                <div class="game-row__meta-label">jugadas</div>
            </div>
        </article>
    `;
}

function gamesStripItemHTML(game) {
    const name = escapeHtml(game.name);

    if (game.isLol) {
        return `
            <li class="games-strip__item">
                <div class="games-strip__thumb">
                    <span>LoL</span>
                </div>
                <span class="games-strip__name">${name}</span>
            </li>
        `;
    }

    return `
        <li class="games-strip__item">
            <div class="games-strip__thumb">
                <img src="${game.header_url}" alt="${name}" loading="lazy" decoding="async"
                     style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
            </div>
            <span class="games-strip__name">${name}</span>
        </li>
    `;
}

function renderGamesList(games) {
    const list = document.getElementById('games-list');
    if (!list) return;

    list.innerHTML = [LOL_GAME, ...games].map(gameRowHTML).join('');
}

function renderGamesStrip(games) {
    const strip = document.getElementById('games-strip');
    if (!strip) return;

    const top4 = [LOL_GAME, ...games.slice(0, 3)];
    strip.innerHTML = top4.map(gamesStripItemHTML).join('');
}

async function initSteamGames() {
    try {
        const response = await fetch(GAMES_ENDPOINT);
        if (!response.ok) return;

        const games = await response.json();
        if (!Array.isArray(games) || games.length === 0) return;

        renderGamesList(games);
        renderGamesStrip(games);
    } catch {
        // Fetch silencioso: se quedan los juegos estáticos del HTML.
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSteamGames);
} else {
    initSteamGames();
}
