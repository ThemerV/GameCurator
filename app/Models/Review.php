<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_igdb_id',
        'title',
        'rating',
        'review',
        'likes',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
