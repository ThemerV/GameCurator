<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'game_id',
        'checksum',
        'url',
    ];

    public function game()
    {
        return Game::whereJsonContains('artworks_array', $this->igdb_id);
    }

}
