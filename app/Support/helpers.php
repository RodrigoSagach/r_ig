<?php

use Illuminate\Support\Facades\Auth;

function excerpt_type($type)
{
    if ($type == 'investment')
        return 'Investment';

    if ($type == 'earning')
        return 'Earning';

    if ($type == 'withdrawal')
        return 'Withdrawal';
}

function format_money($value)
{
    setlocale(LC_MONETARY, 'en_US');
    return money_format('%.2i', $value);
}

function user()
{
    Auth::user();
}

function admin_url($spec)
{
    return url('admin/' . $spec);
}

function user_url($spec)
{
    return url('user/' . $spec);
}