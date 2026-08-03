<?php

return [
    'api_key'   => env('RIOT_API_KEY'),
    'region'    => env('RIOT_REGION', 'la1'),
    'regional'  => env('RIOT_REGIONAL', 'americas'),
    'game_name' => env('RIOT_GAME_NAME'),
    'tag_line'  => env('RIOT_TAG_LINE'),
];
