<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class InvestmentRequest extends Model
{
    protected $fillable = array('amount', 'picture_path');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function excerpt()
    {
        return $this->belongsTo('App\Excerpt');
    }
}
