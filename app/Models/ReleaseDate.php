<?php

namespace App\Models;

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
        'status',
        'y',
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

    public function status() {
        return $this->hasOne(ReleaseDateStatus::class);
    }
}
