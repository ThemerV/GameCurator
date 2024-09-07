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
        'status',
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

    public function artworks() {
        return $this->hasMany(Artwork::class);
    }

    public function collections() {
        return $this->belongsTo(Collection::class);
    }

    public function cover() {
        return $this->hasOne(Cover::class);
    }

    public function franchises() {
        return $this->belongsToMany(Franchise::class);
    }

    public function gameLocalizations() {
        return $this->hasMany(GameLocalization::class);
    }

    public function gameModes() {
        return $this->hasMany(GameMode::class);
    }

    public function genres() {
        return $this->hasMany(Genre::class);
    }

    public function involvedCompanies() {
        return $this->hasMany(InvolvedCompany::class);
    }

    public function languageSupports() {
        return $this->hasMany(LanguageSupport::class);
    }

    public function multiplayerModes() {
        return $this->hasMany(MultiplayerMode::class);
    }

    public function platforms() {
        return $this->hasMany(Platform::class);
    }

    public function playerPerspectives() {
        return $this->hasMany(PlayerPerspective::class);
    }

    public function releaseDates() {
        return $this->hasMany(ReleaseDate::class);
    }

    public function screenshots() {
        return $this->hasMany(Screenshot::class);
    }

    public function themes() {
        return $this->hasMany(Theme::class);
    }

    public function videos() {
        return $this->hasMany(GameVideo::class);
    }

    public function websites() {
        return $this->hasMany(Website::class);
    }

}
