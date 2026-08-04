<?php

// PRODUCCIÓN: Configurar en el servidor web (Hostinger/.htaccess):
// Cache-Control: public, max-age=31536000 para assets estáticos (/build/, /images/)
// Cache-Control: no-cache para HTML

use App\Http\Controllers\RiotController;
use App\Http\Controllers\SteamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('api/lol')->group(function () {
    Route::get('/profile', [RiotController::class, 'profile']);
    Route::get('/live', [RiotController::class, 'live']);
    Route::get('/friends', [RiotController::class, 'friends']);
});

Route::prefix('api/steam')->group(function () {
    Route::get('/games', [SteamController::class, 'games']);
    Route::get('/profile', [SteamController::class, 'profile']);
});
