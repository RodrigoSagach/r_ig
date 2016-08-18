<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FinancesController extends Controller
{
    public function index()
    {
        $total_investments = \App\Investment::all()->sum('amount');
        $total_payouts     = \App\Earning::all()->sum('amount');
        $total_withdrawals = \App\Withdrawal::all()->sum('amount');
        $total_earnings    = $total_investments - $total_payouts - $total_withdrawals;

        return view('admin.finances.index')
            ->with('total_investments', $total_investments)
            ->with('total_payouts', $total_payouts)
            ->with('total_withdrawals', $total_withdrawals)
            ->with('total_earnings', $total_earnings);
    }
}
