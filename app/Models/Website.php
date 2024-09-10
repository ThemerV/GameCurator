<?php

namespace App\Models;

use App\Enums\WebsiteCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'category',
        'trusted',
        'url',
    ];

    protected $casts = [
        'category' => WebsiteCategoryEnum::class,
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

}
