<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
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
        return Game::whereJsonContains('themes_array', $this->igdb_id);
    }

}
