<?php

namespace App\Admin;

use App\Excerpt;
use App\User;

use Symfony\Component\HttpFoundation\ParameterBag;

class StatsManager
{
    public static function getTotalUsers()
    {
        return User::all()->count();
    }

    public static function getActiveUsers()
    {
        return User::where('confirmed', true)->count();
    }

    public static function getStatsBag()
    {
        $bag = new ParameterBag();

        $bag->set('total.users', self::getTotalUsers());

        $bag->set('active.users', self::getActiveUsers());

        return $bag;
    }
}