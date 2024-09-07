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
        'game',
        'name',
        'video_id',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

}
