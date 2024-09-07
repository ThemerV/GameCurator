<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'animated',
        'checksum',
        'height',
        'image_id',
        'url',
        'width',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
