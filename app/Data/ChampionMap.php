<?php

namespace App\Data;

class ChampionMap
{
    public const NAMES = [
        875 => 'Sett',
        18  => 'Tristana',
        145 => "Kai'Sa",
        236 => 'Lucian',
        51  => 'Caitlyn',
        222 => 'Jinx',
        498 => 'Xayah',
        121 => "Kha'Zix",
        238 => 'Zed',
        157 => 'Yasuo',
        64  => 'Lee Sin',
        412 => 'Thresh',
        86  => 'Garen',
        99  => 'Lux',
        39  => 'Irelia',
        266 => 'Aatrox',
        84  => 'Akali',
    ];

    public static function name(int $championId): string
    {
        return self::NAMES[$championId] ?? 'Unknown';
    }
}
