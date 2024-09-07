<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvolvedCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'igdb_id',
        'checksum',
        'company',
        'developer',
        'game',
        'porting',
        'publisher',
        'supporting',
    ];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

}
