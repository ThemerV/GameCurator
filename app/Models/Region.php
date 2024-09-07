<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'category',
        'checksum',
        'identifier',
        'name',
    ];

    public function gameLocalization() {
        return $this->belongsTo(GameLocalization::class);
    }
}
