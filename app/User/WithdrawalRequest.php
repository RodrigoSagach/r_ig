<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = array('account', 'account_info', 'amount', 'description');

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function withdrawal()
    {
        return $this->belongsTo('\App\Withdrawal');
    }
}
