<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyWebsite extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'category',
        'checksum',
        'trusted',
        'url',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
