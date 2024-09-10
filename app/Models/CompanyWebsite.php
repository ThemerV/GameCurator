<?php

namespace App\Models;

use App\Enums\CompanyWebsiteEnum;
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

    protected $casts = [
        'category' => CompanyWebsiteEnum::class,
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
