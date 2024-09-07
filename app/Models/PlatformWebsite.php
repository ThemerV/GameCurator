<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformWebsite extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "category",
        "checksum",
        "trusted",
        "url"
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
