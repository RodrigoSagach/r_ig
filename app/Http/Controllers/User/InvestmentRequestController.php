<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

Use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User\InvestmentRequest;
use Storage;

class InvestmentRequestController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $pendings = $user->investment_requests;

        return view('user.irequests.create')
            ->with('pendings', $pendings);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'receipt' => 'required|image',
            'amount'  => 'required|money_amount:50',
        ]);

        $receipt = $request->file('receipt');

        $user = Auth::user();

        $base = storage_path('app/pictures/irequests/' . $user->username);

        if (!is_dir($base))
            mkdir($base, 0777, true);

        $new_receipt = $receipt->move($base, sprintf("%d.%s", time(), $receipt->getClientOriginalExtension()));

        $user->investment_requests()->create([
            'amount' => floatval($request->input('amount')),
            'picture_path' => $user->username . '/' . $new_receipt->getBasename(),
        ]);

        return redirect('user/investments/new');
    }

    public function show($id)
    {
        $irequest = InvestmentRequest::find($id);

        if (!$irequest) abort(404);

        return view('user.irequests.show')
            ->with('request', $irequest);
    }
}
