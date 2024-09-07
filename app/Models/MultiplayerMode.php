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
        'game',
        'lancoop',
        'offlinecoop',
        'offlinecoopmax',
        'offlinemax',
        'onlinecoop',
        'onlinecoopmax',
        'onlinemax',
        'platform',
        'splitscreen',
        'splitscreenonline',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
