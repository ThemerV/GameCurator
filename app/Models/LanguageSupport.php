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
        'game',
        'language',
        'language_support_type',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function language() {
        return $this->hasMany(Language::class);
    }

    public function languageSupportType() {
        return $this->hasOne(LanguageSupportType::class);
    }
}
