<?php

namespace App\Services;

use App\Data\ChampionMap;
use Illuminate\Support\Facades\Http;
use Throwable;

class RiotApiService
{
    public function getAccountByRiotId(string $gameName, string $tagLine): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/riot/account/v1/accounts/by-riot-id/%s/%s',
                config('riot.regional'),
                rawurlencode($gameName),
                rawurlencode($tagLine),
            ));

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            return [
                'puuid'    => $data['puuid'] ?? null,
                'gameName' => $data['gameName'] ?? null,
                'tagLine'  => $data['tagLine'] ?? null,
            ];
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getSummonerByPuuid(string $puuid): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/lol/summoner/v4/summoners/by-puuid/%s',
                config('riot.region'),
                $puuid,
            ));

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            return [
                'id'             => $data['id'] ?? null,
                'puuid'          => $data['puuid'] ?? null,
                'profileIconId'  => $data['profileIconId'] ?? null,
                'summonerLevel'  => $data['summonerLevel'] ?? null,
            ];
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getRankedStats(string $summonerId): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/lol/league/v4/entries/by-summoner/%s',
                config('riot.region'),
                $summonerId,
            ));

            if (! $response->successful()) {
                return null;
            }

            return $this->extractSoloQueueEntry($response->json());
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Riot está retirando el summonerId de summoner-v4/by-puuid en varias
     * regiones (queda null), así que este es el fallback real para obtener
     * el ranked solo/duo cuando getRankedStats() no puede usarse.
     */
    public function getRankedStatsByPuuid(string $puuid): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/lol/league/v4/entries/by-puuid/%s',
                config('riot.region'),
                $puuid,
            ));

            if (! $response->successful()) {
                return null;
            }

            return $this->extractSoloQueueEntry($response->json());
        } catch (Throwable $e) {
            return null;
        }
    }

    private function extractSoloQueueEntry(mixed $entries): ?array
    {
        $solo = collect($entries)->firstWhere('queueType', 'RANKED_SOLO_5x5');

        if (! $solo) {
            return null;
        }

        return [
            'tier'         => $solo['tier'] ?? null,
            'rank'         => $solo['rank'] ?? null,
            'leaguePoints' => $solo['leaguePoints'] ?? null,
            'wins'         => $solo['wins'] ?? null,
            'losses'       => $solo['losses'] ?? null,
        ];
    }

    public function getActiveGame(string $puuid): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/lol/spectator/v5/active-games/by-summoner/%s',
                config('riot.region'),
                $puuid,
            ));

            if ($response->status() === 404) {
                return null;
            }

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            if (isset($data['participants']) && is_array($data['participants'])) {
                $data['participants'] = collect($data['participants'])
                    ->map(function ($participant) {
                        $participant['championName'] = ChampionMap::name((int) ($participant['championId'] ?? 0));
                        return $participant;
                    })
                    ->all();
            }

            return $data;
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getChampionMasteries(string $puuid, int $count = 5): ?array
    {
        try {
            $response = Http::withHeaders($this->headers())->get(sprintf(
                'https://%s.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-puuid/%s/top',
                config('riot.region'),
                $puuid,
            ), ['count' => $count]);

            if (! $response->successful()) {
                return null;
            }

            return collect($response->json())
                ->map(function ($mastery) {
                    $mastery['championName'] = ChampionMap::name((int) ($mastery['championId'] ?? 0));
                    return $mastery;
                })
                ->all();
        } catch (Throwable $e) {
            return null;
        }
    }

    public function getProfileData(): ?array
    {
        $account = $this->getAccountByRiotId(config('riot.game_name'), config('riot.tag_line'));

        if (! $account || ! $account['puuid']) {
            return null;
        }

        $summoner = $this->getSummonerByPuuid($account['puuid']);
        $ranked = ($summoner['id'] ?? null)
            ? $this->getRankedStats($summoner['id'])
            : null;
        $ranked ??= $this->getRankedStatsByPuuid($account['puuid']);
        $activeGame = $this->getActiveGame($account['puuid']);
        $masteries = $this->getChampionMasteries($account['puuid']);

        return [
            'account'     => $account,
            'summoner'    => $summoner,
            'ranked'      => $ranked,
            'active_game' => $activeGame,
            'masteries'   => $masteries,
        ];
    }

    private function headers(): array
    {
        return [
            'X-Riot-Token' => config('riot.api_key'),
        ];
    }
}
