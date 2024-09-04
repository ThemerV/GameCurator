<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'artworks',
        'category',
        'checksum',
        'collections',
        'cover',
        'dlcs',
        'expansions',
        'franchises',
        'game_localizations',
        'game_modes',
        'genres',
        'involved_companies',
        'language_supports',
        'multiplayer_modes',
        'name',
        'parent_game',
        'platforms',
        'player_perspectives',
        'release_dates',
        'screenshots',
        'similar_games',
        'slug',
        'storyline',
        'summary',
        'themes',
        'url',
        'videos',
        'websites'
    ];

    protected $casts = [
        'artworks' => 'array',
        'collections' => 'array',
        'dlcs' => 'array',
        'expansions' => 'array',
        'franchises' => 'array',
        'game_localizations' => 'array',
        'game_modes' => 'array',
        'genres' => 'array',
        'involved_companies' => 'array',
        'language_supports' => 'array',
        'multiplayer_modes' => 'array',
        'platforms' => 'array',
        'player_perspectives' => 'array',
        'release_dates' => 'array',
        'screenshots' => 'array',
        'similar_games' => 'array',
        'standalone_expansions' => 'array',
        'themes' => 'array',
        'videos' => 'array',
        'websites' => 'array',
        'first_release_date' => 'datetime',
    ];
}
