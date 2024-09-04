<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'animated',
        'checksum',
        'game_igdb_id',
        'height',
        'image_id',
        'url',
        'width'
    ];
}
