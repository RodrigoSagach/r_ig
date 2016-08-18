<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'last_name', 'email', 'password', 'confirmation_code', 'confirmed',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['profile_picture_url'];

    public static function admin()
    {
        return self::where('is_admin', true)->first();
    }

    public function investment_requests()
    {
        return $this->hasMany('\App\User\InvestmentRequest');
    }

    public function withdrawal_requests()
    {
        return $this->hasMany('\App\User\WithdrawalRequest');
    }

    public function excerpts()
    {
        return $this->hasMany('\App\Excerpt');
    }

    public function getProfilePictureUrlAttribute()
    {
        if ($this->picture_path)
        {
            return url('/pictures/profile/' . $this->id);
        }

        return url('/images/avatars/default_avatar.png');
    }
}
