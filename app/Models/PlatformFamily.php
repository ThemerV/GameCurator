<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "checksum",
        "name",
        "slug"
    ];

    public function platforms() {
        return $this->hasMany(Platform::class);
    }

}
