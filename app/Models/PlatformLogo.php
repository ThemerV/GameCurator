<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "animated",
        "checksum",
        "height",
        "image_id",
        "url",
        "width"
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
