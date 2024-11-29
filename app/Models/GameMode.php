<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'name',
        'slug',
    ];

    public function games()
    {
        // Query Game records where the `game_modes_array` JSON contains this GameMode's `igdb_id`
        return Game::whereJsonContains('game_modes_array', $this->igdb_id)->get();
    }


}
