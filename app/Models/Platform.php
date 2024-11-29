<?php

namespace App\Models;

use App\Enums\PlatformCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'abbreviation',
        'category',
        'checksum',
        'generation',
        'name',
        'platform_family_id',
        'platform_logo_id',
        'slug',
        'summary',
        'websites_array',
    ];

    protected $casts = [
        'category' => PlatformCategoryEnum::class,
        'websites_array' => 'array',
    ];

    public function games()
    {
        return Game::whereJsonContains('platforms_array', $this->igdb_id);
    }

    public function family() {
        return $this->belongsTo(PlatformFamily::class);
    }

    public function logo() {
        return $this->hasOne(PlatformLogo::class);
    }

    public function releaseDates() {
        return $this->hasMany(ReleaseDate::class);
    }

    public function websites() {
        return $this->hasMany(PlatformWebsite::class);
    }
}
