<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
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
        return Game::whereJsonContains('genres_array', $this->igdb_id);
    }

}
