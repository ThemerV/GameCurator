<?php

namespace App\Models;

use App\Enums\CompanyWebsiteCategoryEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyWebsite extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'category',
        'checksum',
        'url',
    ];

    protected $casts = [
        'category' => CompanyWebsiteCategoryEnum::class,
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
