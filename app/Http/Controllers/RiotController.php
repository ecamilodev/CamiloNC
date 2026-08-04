<?php

namespace App\Http\Controllers;

use App\Services\RiotApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Throwable;

class RiotController extends Controller
{
    /**
     * Amigos del squad para el endpoint /api/lol/friends. Riot ID exacto tal
     * como está registrado en cada cuenta (ojo: 'BRlLLITOSH' usa una L
     * minúscula, no una I mayúscula — el apodo mostrado sí es 'BRILLITOSH').
     */
    private array $friends = [
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

    public function __construct(private RiotApiService $riot)
    {
    }

    public function profile(): JsonResponse
    {
        $data = Cache::remember('riot_profile', 300, fn () => $this->riot->getProfileData());

        return response()->json($data ?? []);
    }

    public function live(): JsonResponse
    {
        $account = Cache::remember('riot_account', 3600, fn () => $this->riot->getAccountByRiotId(
            config('riot.game_name'),
            config('riot.tag_line'),
        ));

        $puuid = $account['puuid'] ?? null;

        if (! $puuid) {
            return response()->json(['in_game' => false, 'game_data' => null]);
        }

        $game = $this->riot->getActiveGame($puuid);

        return response()->json([
            'in_game'   => $game !== null,
            'game_data' => $game,
        ]);
    }

    public function friends(): JsonResponse
    {
        $data = Cache::remember('riot_friends', 300, function () {
            $results = [];

            foreach ($this->friends as $friend) {
                $results[] = $this->fetchFriend($friend);

                // Rate limit de Riot: 20 req/s y 100 cada 2 min. Con ~3 requests
                // por amigo, 100ms de margen entre amigos deja bastante colchón.
                usleep(100_000);
            }

            return $results;
        });

        return response()->json($data ?? []);
    }

    private function fetchFriend(array $friend): array
    {
        $base = [
            'nick'             => $friend['nick'],
            'riot_id'          => $friend['riot_id'],
            'tag'              => $friend['tag'],
            'tier'             => null,
            'rank'             => null,
            'lp'               => null,
            'in_game'          => false,
            'level'            => null,
            'profile_icon_id'  => null,
            'profile_icon_url' => null,
        ];

        try {
            $account = $this->riot->getAccountByRiotId($friend['riot_id'], $friend['tag']);
            $puuid = $account['puuid'] ?? null;

            if (! $puuid) {
                return $base;
            }

            $summoner = $this->riot->getSummonerByPuuid($puuid);
            $ranked = $this->riot->getRankedStatsByPuuid($puuid);
            $activeGame = $this->riot->getActiveGame($puuid);

            // TODO: actualizar versión de Data Dragon cuando haya nuevo parche de LoL
            $iconUrl = $summoner && isset($summoner['profileIconId'])
                ? "https://ddragon.leagueoflegends.com/cdn/15.14.1/img/profileicon/{$summoner['profileIconId']}.png"
                : null;

            return [
                ...$base,
                'tier'             => $ranked['tier'] ?? null,
                'rank'             => $ranked['rank'] ?? null,
                'lp'               => $ranked['leaguePoints'] ?? null,
                'in_game'          => $activeGame !== null,
                'level'            => $summoner['summonerLevel'] ?? null,
                'profile_icon_id'  => $summoner['profileIconId'] ?? null,
                'profile_icon_url' => $iconUrl,
            ];
        } catch (Throwable $e) {
            return $base;
        }
    }
}
