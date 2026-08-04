<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SpotifyService
{
    public static function getPlaylistCover(string $playlistId): ?string
    {
        return Cache::remember("spotify_cover_{$playlistId}", 86400, function () use ($playlistId) {
            try {
                $response = Http::get('https://open.spotify.com/oembed', [
                    'url' => "https://open.spotify.com/playlist/{$playlistId}",
                ]);

                if ($response->successful()) {
                    return $response->json('thumbnail_url');
                }
            } catch (\Exception $e) {
                // Silencioso
            }

            return null;
        });
    }
}
