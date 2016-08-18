<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $withdrawals = \App\Withdrawal::orderBy('id', 'ASC');

        if ($request->has('s'))
            $withdrawals->where('description', 'LIKE', psp($request->input('s')));

        return view('admin.finances.withdrawals.index')
            ->with('withdrawals', $withdrawals->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.finances.withdrawals.create')
            ->with('client', $request->has('user_id') ? \App\User::find($request->input('user_id')) : null);
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
            'client_id' => 'required|exists:users,id',
            'account' => 'required|integer|in:0,1',
            'accountInfo' => 'required_if:account,1',
            'amount' => 'required|digits_between:3,15'
        ]);

        $user        = \App\User::find($request->input('client_id'));
        $accountInfo = $request->input('accountInfo');
        $amount      = $request->input('amount') / 100;

        if ($request->input('account') == 0)
        {
            $accountInfo = sprintf("Titular: %s\n", $user->holder);
            $accountInfo .= sprintf("Banco: %s\n", $user->bank);
            $accountInfo .= sprintf("Agência: %s\n", $user->agency);
            $accountInfo .= sprintf("Conta: %s\n", $user->account);
            $accountInfo .= sprintf("Tipo: %s\n", $user->account_type == 0 ? 'Corrente' : 'Poupança');
        }

        $accountInfo .= sprintf("\n\nValor Requerido: %s", format_money($amount));

        $user->withdrawals()->create([
            'account_info' => $accountInfo,
            'amount' => $amount,
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.finance.withdrawals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Withdrawal::destroy($id);

        return redirect()->route('admin.finance.withdrawals.index');
    }
}
