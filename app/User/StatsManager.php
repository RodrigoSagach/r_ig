<?php

namespace App\User;

use App\User;
use App\InvestmentRequest;
use App\Excerpt;

use Symfony\Component\HttpFoundation\ParameterBag;

class StatsManager
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getTotalVested()
    {
        $investments = $this->user->excerpts->where('type', 'investment')->sum('amount');

        return $investments;
    }

    public function getTotalEarned()
    {
        return $this->user->excerpts->where('type', 'earning')->sum('amount');
    }

    public function getNextPaymentValue()
    {
        return $this->getTotalVested() * (config('settings.earning.percentage') / 100);
    }

    public function getStatsBag()
    {
        $bag = new ParameterBag();

        $bag->set('total.vested', $this->getTotalVested());
        $bag->set('total.earned', $this->getTotalEarned());
        $bag->set('next_payment_value', $this->getNextPaymentValue());

        return $bag;
    }
}
