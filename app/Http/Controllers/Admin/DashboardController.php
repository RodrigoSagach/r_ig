<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index')
            ->with('stats', \App\Admin\StatsManager::getStatsBag());
    }

    

    public function deleteUser($id)
    {
        \App\User::destroy($id);

        return redirect()->route('admin::users');
    }

    public function total_26w($id)
    {
        $user = \App\User::find($id);

        $iTotal = $user->investments()->whereIn('type', ['byrequest', 'manual'])->sum('amount');
        $wTotal = $user->withdrawals()->sum('amount');

        // Total without any withdrawal (Compound)
        $nwTotal = $iTotal * pow((1 + 0.18), 26);

        // Apporx with withdrawal (Compound)
        $one = $iTotal * .18;
        $num = floor($wTotal / $one);
        $wwTotal = $iTotal * pow((1 + 0.18), 26 - $num);

        // Total not compound
        $byw = $iTotal * .18;
        $ncTotal = $iTotal + (26 * $byw);

        return view('admin.total_26w')
            ->with('nwTotal', $nwTotal)
            ->with('wwTotal', $wwTotal)
            ->with('ncTotal', $ncTotal);
    }
}
