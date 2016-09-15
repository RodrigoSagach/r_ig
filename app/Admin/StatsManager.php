<?php

namespace App\Admin;

use App\Excerpt;
use App\User;

use Symfony\Component\HttpFoundation\ParameterBag;

class StatsManager
{
    public static function getInvested()
    {
        return Excerpt::where('type', 'investment')->sum('amount');
    }

    public static function getPaid()
    {
        return Excerpt::where('type', 'earning')->sum('amount');
    }

    public static function getDrawee()
    {
        return Excerpt::where('type', 'withdrawal')->sum('amount');
    }

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

        $bag->set('invested', self::getInvested());
        $bag->set('paid', self::getPaid());
        $bag->set('drawee', self::getDrawee());

        $bag->set('total.users', self::getTotalUsers());

        $bag->set('active.users', self::getActiveUsers());

        return $bag;
    }
}