<?php

namespace App\Http\Controllers;

use App\Services\SteamApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class SteamController extends Controller
{
    public function __construct(private SteamApiService $steam)
    {
    }

    public function games(): JsonResponse
    {
        $games = Cache::remember('steam_games', 1800, fn () => $this->steam->getTopGames(10));

        return response()->json($games ?? []);
    }

    public function profile(): JsonResponse
    {
        $data = Cache::remember('steam_profile', 600, function () {
            $summary = $this->steam->getPlayerSummary();
            $level = $this->steam->getSteamLevel();

            if (! $summary) {
                return null;
            }

            $enJuego = $summary['gameextrainfo'] ?? null;

            return [
                'nombre'       => $summary['personaname'] ?? null,
                'avatar'       => $summary['avatarfull'] ?? null,
                'perfil_url'   => $summary['profileurl'] ?? null,
                'nivel'        => $level,
                'estado'       => $enJuego ? 'in-game' : (($summary['personastate'] ?? 0) === 0 ? 'offline' : 'online'),
                'juego_actual' => $enJuego,
            ];
        });

        return response()->json($data ?? []);
    }
}
