<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class SteamApiService
{
    public function getOwnedGames(): ?array
    {
        try {
            $response = Http::get('http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/', [
                'key'                      => config('steam.api_key'),
                'steamid'                  => config('steam.steam_id'),
                'include_appinfo'          => 1,
                'include_played_free_games' => 1,
                'format'                   => 'json',
            ]);

            if (! $response->successful()) {
                return null;
            }

            $games = $response->json('response.games');

            if (! is_array($games)) {
                return null;
            }

            return collect($games)
                ->map(fn ($game) => [
                    'appid'             => $game['appid'] ?? null,
                    'name'              => $game['name'] ?? null,
                    'playtime_forever'  => $game['playtime_forever'] ?? 0,
                    'img_icon_url'      => $game['img_icon_url'] ?? null,
                    'img_logo_url'      => $game['img_logo_url'] ?? null,
                ])
                ->sortByDesc('playtime_forever')
                ->values()
                ->all();
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getRecentlyPlayed(): ?array
    {
        try {
            $response = Http::get('http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v0001/', [
                'key'     => config('steam.api_key'),
                'steamid' => config('steam.steam_id'),
                'count'   => 5,
                'format'  => 'json',
            ]);

            if (! $response->successful()) {
                return null;
            }

            return $response->json('response.games');
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getPlayerSummary(): ?array
    {
        try {
            $response = Http::get('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/', [
                'key'      => config('steam.api_key'),
                'steamids' => config('steam.steam_id'),
                'format'   => 'json',
            ]);

            if (! $response->successful()) {
                return null;
            }

            $players = $response->json('response.players');

            if (! is_array($players) || ! isset($players[0])) {
                return null;
            }

            $player = $players[0];

            return [
                'personaname'    => $player['personaname'] ?? null,
                'avatarfull'     => $player['avatarfull'] ?? null,
                'profileurl'     => $player['profileurl'] ?? null,
                'personastate'   => $player['personastate'] ?? 0,
                'gameextrainfo'  => $player['gameextrainfo'] ?? null,
            ];
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getSteamLevel(): ?int
    {
        try {
            $response = Http::get('http://api.steampowered.com/IPlayerService/GetSteamLevel/v1/', [
                'key'     => config('steam.api_key'),
                'steamid' => config('steam.steam_id'),
                'format'  => 'json',
            ]);

            if (! $response->successful()) {
                return null;
            }

            $level = $response->json('response.player_level');

            return $level !== null ? (int) $level : null;
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getTopGames(int $limit = 10): ?array
    {
        $games = $this->getOwnedGames();

        if (! $games) {
            return null;
        }

        return collect($games)
            ->take($limit)
            ->map(fn ($game) => [
                'appid'          => $game['appid'],
                'name'           => $game['name'],
                'playtime_hours' => (int) round(($game['playtime_forever'] ?? 0) / 60),
                'icon_url'       => $game['img_icon_url']
                    ? "https://media.steampowered.com/steamcommunity/public/images/apps/{$game['appid']}/{$game['img_icon_url']}.jpg"
                    : null,
                'header_url'     => "https://cdn.akamai.steamstatic.com/steam/apps/{$game['appid']}/header.jpg",
            ])
            ->values()
            ->all();
    }
}
