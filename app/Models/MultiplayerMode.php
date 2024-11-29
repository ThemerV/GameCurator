<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiplayerMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'dropin',
        'game_id',
        'lancoop',
        'offlinecoop',
        'offlinecoopmax',
        'offlinemax',
        'onlinecoop',
        'onlinecoopmax',
        'onlinemax',
        'platform_id',
        'splitscreen',
        'splitscreenonline',
    ];

    public function game() {
        return $this->belongsToMany(Game::class, 'game_multiplayer_mode', 'multiplayer_mode_igdb_id', 'game_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function platform() {
        return $this->hasMany(Platform::class);
    }

}
