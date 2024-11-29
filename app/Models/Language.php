<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'name',
        'native_name',
    ];

    public function languageSupport() {
        return $this->hasMany(LanguageSupport::class);
    }


}
