<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "checksum",
        "url",
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
