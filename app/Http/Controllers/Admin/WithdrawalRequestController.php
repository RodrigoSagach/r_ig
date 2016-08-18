<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User\WithdrawalRequest;
use Illuminate\Http\Request;

class WithdrawalRequestController extends Controller
{
    public function index()
    {
        $requests = WithdrawalRequest::where('status', '0')->orderBy('created_at', 'DESC')->paginate(15);

        return view('admin.wrequests.index')
            ->with('requests', $requests);
    }

    public function show($id)
    {
        $req = WithdrawalRequest::find($id);

        if (!$req) abort(404);

        return view('admin.wrequests.show')
            ->with('request', $req);
    }

    public function postStatus(Request $request, $id)
    {
        $this->validate($request, [
            'response' => 'present|string',
            'status' => 'required|integer'
        ]);

        $wrequest = \App\WithdrawalRequest::find($id);
        $wrequest->response = $request->input('response');
        $wrequest->status   = $request->input('status');

        if ($request->input('status') == 1)
        {
            $withdrawal = $wrequest->user->withdrawals()->create([
                'description' => 'Requisição de Saque',
                'account_info' => $wrequest->account_info,
                'amount' => $wrequest->amount
            ]);

            $wrequest->withdrawal_id = $withdrawal->id;
        }

        $wrequest->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\WithdrawalRequest::destroy($id);

        return redirect()->route('admin.finance.wrequests.index');
    }
}
