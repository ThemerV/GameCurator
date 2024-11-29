<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSupportType extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'name',
    ];

    public function languageSupports() {
        return $this->hasMany(LanguageSupport::class);
    }
}
