<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'game_id',
        'name',
        'video_id',
    ];

    public function game() {
        return $this->belongsToMany(Game::class, 'game_game_video', 'video_igdb_id', 'game_igdb_id', 'igdb_id', 'igdb_id');
    }

}
