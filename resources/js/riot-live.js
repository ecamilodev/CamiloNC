/**
 * Consume la API interna /api/lol/* (backend, que a su vez llama a Riot Games)
 * para actualizar el profile-card con datos reales y marcar cuándo hay una
 * partida en curso. Los valores del HTML son el fallback: si algo falla
 * (key vencida, red caída, etc.) simplemente se quedan como están.
 */
const PROFILE_ENDPOINT = '/api/lol/profile';
const LIVE_ENDPOINT = '/api/lol/live';
const LIVE_CHECK_INTERVAL = 90000;

// Community Dragon no publica un PNG de Emerald en este set de emblemas
// (solo SVG); el resto de tiers sí tienen PNG. Ver public/images/ranks/.
const RANK_EMBLEM_EXT = { emerald: 'svg' };

function setText(id, value) {
    if (value === null || value === undefined || value === '') return;
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}

function applyProfileData(data) {
    const ranked = data && data.ranked;
    if (!ranked) return;

    if (ranked.tier && ranked.rank) {
        setText('rank-text', `${ranked.tier} ${ranked.rank}`);
    }

    const emblem = document.getElementById('rank-emblem');
    if (emblem && ranked.tier) {
        const tier = ranked.tier.toLowerCase();
        const ext = RANK_EMBLEM_EXT[tier] || 'png';
        emblem.src = '/images/ranks/' + tier + '.' + ext;
        emblem.alt = ranked.tier;
    }

    if (typeof ranked.leaguePoints === 'number') {
        setText('lp-text', `${ranked.leaguePoints} LP`);
    }

    const wins = ranked.wins;
    const losses = ranked.losses;
    if (typeof wins === 'number' && typeof losses === 'number' && wins + losses > 0) {
        const total = wins + losses;
        setText('games-text', String(total));
        setText('winrate-text', `${Math.round((wins / total) * 100)}%`);
    }
}

async function fetchProfile() {
    try {
        const response = await fetch(PROFILE_ENDPOINT);
        if (!response.ok) return;
        applyProfileData(await response.json());
    } catch {
        // Catch silencioso: se queda el fallback estático del HTML.
    }
}

async function checkLiveGame() {
    try {
        const response = await fetch(LIVE_ENDPOINT);
        if (!response.ok) return;
        const data = await response.json();
        document.body.classList.toggle('is-ingame', Boolean(data.in_game));
    } catch {
        // Catch silencioso: no tocar el estado actual.
    }
}

function initRiotLive() {
    fetchProfile();
    checkLiveGame();
    setInterval(checkLiveGame, LIVE_CHECK_INTERVAL);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initRiotLive);
} else {
    initRiotLive();
}
