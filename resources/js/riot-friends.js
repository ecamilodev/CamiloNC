/**
 * Consume /api/lol/friends (backend, que llama a la Riot API para cada amigo
 * del squad) y actualiza el punto de estado, el texto y el rango de cada
 * tarjeta .friend. Si el fetch falla o un amigo no tiene datos, esa tarjeta
 * se queda en su estado "Offline" por defecto — sin mostrar errores.
 */
const FRIENDS_ENDPOINT = '/api/lol/friends';
const REFRESH_INTERVAL = 180000;

const TIER_NAMES = {
    IRON: 'Iron',
    BRONZE: 'Bronze',
    SILVER: 'Silver',
    GOLD: 'Gold',
    PLATINUM: 'Platinum',
    EMERALD: 'Emerald',
    DIAMOND: 'Diamond',
    MASTER: 'Master',
    GRANDMASTER: 'Grandmaster',
    CHALLENGER: 'Challenger',
};

function formatRank(tier, rank) {
    if (!tier) return '';
    const name = TIER_NAMES[tier] || tier;
    return rank ? `${name} ${rank}` : name;
}

function setDotAndStatus(card, dotClass, statusText, statusClass) {
    const dot = card.querySelector('[id^="friend-dot-"]');
    const status = card.querySelector('[id^="friend-status-"]');

    if (dot) {
        dot.className = `friend__dot friend__dot--${dotClass}`;
    }

    if (status) {
        status.textContent = statusText;
        status.className = statusClass ? `friend__status friend__status--${statusClass}` : 'friend__status';
    }
}

function updateAvatar(index, friend) {
    const avatar = document.getElementById(`friend-avatar-${index}`);
    if (!avatar || !friend.profile_icon_url) return;

    const letter = avatar.querySelector('.friend__avatar-letter');
    if (!letter) return;

    const img = document.createElement('img');
    img.src = friend.profile_icon_url;
    img.alt = friend.nick;
    img.className = 'friend__avatar-img';
    img.loading = 'lazy';
    img.decoding = 'async';
    img.onerror = function () {
        // Si la imagen falla, volver a mostrar la letra
        this.style.display = 'none';
        letter.style.display = '';
    };
    letter.style.display = 'none';
    // Insertar la imagen antes del dot, no después
    const dot = avatar.querySelector('.friend__dot');
    avatar.insertBefore(img, dot);
}

function applyFriendData(friend) {
    const card = document.querySelector(
        `.friend[data-riot-id="${CSS.escape(friend.riot_id)}"][data-riot-tag="${CSS.escape(friend.tag)}"]`,
    );
    if (!card) return;

    const rankEl = card.querySelector('[id^="friend-rank-"]');
    if (rankEl) {
        rankEl.textContent = formatRank(friend.tier, friend.rank);
    }

    // El index se obtiene del id real del elemento (friend-0, friend-1, ...)
    // en vez de asumir que coincide con la posición en la respuesta JSON.
    const index = card.id.replace('friend-', '');
    updateAvatar(index, friend);

    if (friend.in_game) {
        setDotAndStatus(card, 'ingame', 'En partida', 'ingame');
        return;
    }

    if (friend.tier) {
        setDotAndStatus(card, 'online', 'En línea', 'online');
        return;
    }

    setDotAndStatus(card, 'offline', 'Offline', null);
}

async function loadFriends() {
    try {
        const response = await fetch(FRIENDS_ENDPOINT);
        if (!response.ok) return;

        const friends = await response.json();
        if (!Array.isArray(friends)) return;

        friends.forEach(applyFriendData);
    } catch {
        // Fetch silencioso: las tarjetas se quedan como están.
    }
}

function initRiotFriends() {
    loadFriends();
    setInterval(loadFriends, REFRESH_INTERVAL);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initRiotFriends);
} else {
    initRiotFriends();
}
