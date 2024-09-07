<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'animated',
        'checksum',
        'game',
        'height',
        'image_id',
        'url',
        'width',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

}
