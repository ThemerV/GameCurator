<?php

namespace App\Models;

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
        'platform_family',
        'platform_logo',
        'slug',
        'summary',
        'url',
        'websites',
    ];

    protected $casts = [
        'websites' => 'array',
    ];

    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function family() {
        return $this->belongsTo(PlatformFamily::class);
    }

    public function logo() {
        return $this->hasOne(PlatformLogo::class);
    }

    public function websites() {
        return $this->hasMany(PlatformWebsite::class);
    }

}
