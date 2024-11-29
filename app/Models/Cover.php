<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'url',
    ];

    public function game() {
        return $this->belongsTo(Game::class, 'cover_id', 'igdb_id');
    }
}
