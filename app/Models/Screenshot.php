<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'game_id',
        'url',
    ];

    public function game() {
        return $this->belongsToMany(Game::class, 'game_screenshot', 'screenshot_igdb_id', 'game_igdb_id', 'igdb_id', 'igdb_id');
    }

}
