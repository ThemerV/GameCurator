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
        'game',
        'human',
        'platform',
        'release_date',
        'region',
        'y',
    ];

    protected $casts = [
        'region' => ReleaseDateRegionEnum::class,
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

    public function region() {
        return $this->hasOne(Region::class);
    }
}
