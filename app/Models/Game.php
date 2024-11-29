<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\GameCategoryEnum;
use App\Enums\GameStatusEnum;
use Illuminate\Support\Facades\Log;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'artworks_array',
        'category',
        'checksum',
        'collections_array',
        'cover_id',
        'dlcs_array',
        'expansions_array',
        'first_release_date',
        'franchises_array',
        'game_modes_array',
        'genres_array',
        'involved_companies_array',
        'language_supports_array',
        'multiplayer_modes_array',
        'name',
        'parent_game_id',
        'platforms_array',
        'player_perspectives_array',
        'release_dates_array',
        'screenshots_array',
        'similar_games_array',
        'slug',
        'status',
        'storyline',
        'summary',
        'themes_array',
        'videos_array',
        'websites_array'
    ];

    protected $casts = [
        'artworks_array' => 'array',
        'category' => GameCategoryEnum::class,
        'collections_array' => 'array',
        'dlcs_array' => 'array',
        'expansions_array' => 'array',
        'franchises_array' => 'array',
        'game_modes_array' => 'array',
        'genres_array' => 'array',
        'involved_companies_array' => 'array',
        'language_supports_array' => 'array',
        'multiplayer_modes_array' => 'array',
        'platforms_array' => 'array',
        'player_perspectives_array' => 'array',
        'release_dates_array' => 'array',
        'screenshots_array' => 'array',
        'similar_games_array' => 'array',
        'standalone_expansions' => 'array',
        'status' => GameStatusEnum::class,
        'themes_array' => 'array',
        'videos_array' => 'array',
        'websites_array' => 'array',
        'first_release_date' => 'datetime',
    ];

    public function artworks()
    {
        return Artwork::whereIn('igdb_id', $this->artworks_array ?? [])->get();
    }

    public function collections() {
        return $this->belongsToMany(Collection::class, 'collection_game', 'game_igdb_id', 'collection_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function cover() {
        return $this->hasOne(Cover::class, 'igdb_id', 'cover_id');
    }

    public function dlcs() {
        return $this->hasMany(Game::class, 'parent_game_id', 'igdb_id')
                    ->where('category', GameCategoryEnum::dlc_addon);
    }

    public function expansions() {
        return $this->hasMany(Game::class, 'parent_game_id', 'igdb_id')->get();
    }

    public function franchises() {
        return $this->belongsToMany(Franchise::class, 'franchise_game', 'game_igdb_id', 'franchise_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function parentGame() {
        return $this->belongsTo(Game::class, 'igdb_id', 'parent_game_id');
    }

    public function gameModes()
    {
        return GameMode::whereIn('igdb_id', $this->game_modes_array ?? [])->get();
    }

    public function genres()
    {
        return Genre::whereIn('igdb_id', $this->genres_array ?? [])->get();
    }

    public function involvedCompanies()
    {
        return InvolvedCompany::whereIn('igdb_id', $this->involved_companies_array ?? [])->get();
    }

    public function languageSupports() {
        return $this->belongsToMany(LanguageSupport::class, 'language_support_game', 'game_igdb_id', 'language_support_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function multiplayerModes() {
        return $this->belongsToMany(MultiplayerMode::class, 'game_multiplayer_mode', 'game_igdb_id', 'multiplayer_mode_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function platforms()
    {
        return Platform::whereIn('igdb_id', $this->platforms_array ?? [])->get();
    }

    public function playerPerspectives()
    {
        return PlayerPerspective::whereIn('igdb_id', $this->player_perspectives_array ?? [])->get();
    }

    public function releaseDates()
    {
        return $this->belongsToMany(ReleaseDate::class, 'game_release_date', 'game_igdb_id', 'release_date_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function screenshots()
    {
        return $this->belongsToMany(Screenshot::class, 'game_screenshot', 'game_igdb_id', 'screenshot_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function similarGames()
    {
        return $this->hasMany(self::class, 'igdb_id', 'similar_games_array')
                    ->whereIn('igdb_id', $this->similar_games_array ?? []);
    }

    public function themes()
    {
        return Theme::whereIn('igdb_id', $this->themes_array ?? [])->get();
    }

    public function videos()
    {
        return $this->belongsToMany(GameVideo::class, 'game_game_videos', 'game_igdb_id', 'video_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function websites()
    {
        return Website::whereIn('igdb_id', $this->websites_array ?? [])->get();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'game_igdb_id', 'igdb_id');
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_game', 'game_igdb_id', 'playlist_id', 'igdb_id', 'id')
                    ->withTimestamps();
    }


}
