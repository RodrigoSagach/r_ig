<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    protected $fillable = array('account_type', 'account_value', 'amount', 'description');

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function withdrawal()
    {
        return $this->belongsTo('\App\Withdrawal');
    }
}
