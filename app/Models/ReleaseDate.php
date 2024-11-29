<?php

namespace App\Models;

use App\Enums\ReleaseDateRegionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'date',
        'game_id',
        'human',
        'platform_id',
        'region',
        'y',
    ];

    protected $casts = [
        'region' => ReleaseDateRegionEnum::class,
    ];

    public function game() {
        return $this->belongsToMany(Game::class, 'game_release_date', 'release_date_igdb_id', 'game_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
