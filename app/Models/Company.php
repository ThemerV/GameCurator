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
        'description',
        'developed',
        'logo',
        'name',
        'published',
        'slug',
        'websites_array',
    ];

    protected $casts = [
        'developed' => 'array',
        'published' => 'array',
        'websites_array' => 'array',
    ];

    public function developed() {
        return $this->hasMany(Game::class);
    }

    public function	involvedCompanies() {
        return $this->hasMany(InvolvedCompany::class);
    }

    public function logo() {
        return $this->hasOne(CompanyLogo::class);
    }

    public function published() {
        return $this->hasMany(Game::class);
    }

    public function websites() {
        return $this->hasMany(CompanyWebsite::class);
    }

}
