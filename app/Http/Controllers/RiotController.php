<?php

namespace App\Http\Controllers;

use App\Services\RiotApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class RiotController extends Controller
{
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
}
