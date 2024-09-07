<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'country',
        'description',
        'developed',
        'logo',
        'name',
        'parent',
        'published',
        'slug',
        'url',
        'websites',
    ];

    protected $casts = [
        'websites' => 'array',
    ];

    public function developed() {
        return $this->hasMany(Game::class);
    }

    public function published() {
        return $this->hasMany(Game::class);
    }

    public function parent() {
        return $this->belongsTo(Company::class, 'parent');
    }

    public function websites() {
        return $this->hasMany(CompanyWebsite::class);
    }

}
