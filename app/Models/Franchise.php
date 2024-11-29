<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'games_array',
        'name',
        'slug',
    ];

    protected $casts = [
        'games_array' => 'array'
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'franchise_game',
            'franchise_igdb_id', 'game_igdb_id',
            'igdb_id', 'igdb_id');
    }

}
