/**
 * Detecta si el canal de Twitch está en vivo y controla el badge .live-badge.
 * Sin credenciales configuradas (VITE_TWITCH_CLIENT_ID / VITE_TWITCH_TOKEN),
 * no hace ningún fetch: simplemente deja el badge oculto.
 */
const CHANNEL = 'camilo_nc';
const CHECK_INTERVAL = 60000;

const CLIENT_ID = import.meta.env.VITE_TWITCH_CLIENT_ID;
const TOKEN = import.meta.env.VITE_TWITCH_TOKEN;

function isPlaceholder(value) {
    return !value || value.startsWith('PLACEHOLDER');
}

function hasCredentials() {
    return !isPlaceholder(CLIENT_ID) && !isPlaceholder(TOKEN);
}

function setLive(isLive) {
    document.body.classList.toggle('is-live', isLive);
}

async function checkLiveStatus() {
    try {
        const response = await fetch(`https://api.twitch.tv/helix/streams?user_login=${CHANNEL}`, {
            headers: {
                'Client-ID': CLIENT_ID,
                'Authorization': `Bearer ${TOKEN}`,
            },
        });

        if (!response.ok) {
            setLive(false);
            return;
        }

        const data = await response.json();
        setLive(Array.isArray(data.data) && data.data.length > 0);
    } catch {
        setLive(false);
    }
}

function initTwitchStatus() {
    if (!hasCredentials()) {
        setLive(false);
        return;
    }

    checkLiveStatus();
    setInterval(checkLiveStatus, CHECK_INTERVAL);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTwitchStatus);
} else {
    initTwitchStatus();
}
