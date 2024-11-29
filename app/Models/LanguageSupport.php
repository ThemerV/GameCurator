<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'game_id',
        'language_id',
        'language_support_type_id',
    ];

    public function game() {
        return $this->belongsToMany(Game::class, 'language_support_game', 'language_support_igdb_id', 'game_igdb_id', 'igdb_id', 'igdb_id');
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function languageSupportType() {
        return $this->belongsTo(LanguageSupportType::class, 'game_id', 'igdb_id');
    }
}
