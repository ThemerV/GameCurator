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
        'locale',
        'name',
        'native_name',
    ];

    public function languageSupport() {
        return $this->belongsTo(LanguageSupport::class);
    }


}
