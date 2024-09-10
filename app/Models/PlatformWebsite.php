<?php

namespace App\Models;

use App\Enums\PlatformWebsiteCategoryEnum;
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

    protected $casts = [
        'category' => PlatformWebsiteCategoryEnum::class,
    ];

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

}
