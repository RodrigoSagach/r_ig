<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WithdrawalRequestController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pendings = Auth::user()->withdrawal_requests()->orderBy('created_at', 'DESC')->get();

        return view('user.wrequests.create')
            ->with('pendings', $pendings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|balance|money_amount:50'
        ]);

        $user = Auth::user();

        $amount = floatval($request->input('amount'));

        $user->withdrawal_requests()->create([
            'account_type'  => $user->account_type,
            'account_value' => $user->account_value,
            'amount'        => $amount,
            'description'   => 'User Requested Withdrawal'
        ]);

        $request->session()->flash('success', true);

        return back();
    }
}
