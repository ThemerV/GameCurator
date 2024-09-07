<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseDateStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "checksum",
        "description",
        "name"
    ];

    public function releaseDate() {
        return $this->hasMany(ReleaseDate::class);
    }
}
