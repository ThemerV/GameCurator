<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true; // Or add your access logic here
    }

    public function canAccessFilament(): bool
    {
        // Implement any authorization logic if needed
        return true;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->username = strtolower(str_replace(' ', '_', $user->name)); // Automatically set username from name, you can change this logic
        });
    }

}
