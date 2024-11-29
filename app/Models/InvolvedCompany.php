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
        'company_id',
        'developer',
        'game_id',
        'porting',
        'publisher',
        'supporting',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function game()
    {
        return Game::whereJsonContains('involved_companies_array', $this->igdb_id);
    }

}
