<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User\InvestmentRequest;

class InvestmentRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = InvestmentRequest::where('status', $request->input('status', 0))
            ->orderBy('id', 'DESC')->paginate(25);

        return view('admin.irequests.index')
            ->with('requests', $requests);
    }

    public function show($irequest)
    {
        return view('admin.irequests.show')
            ->with('request', $irequest);
    }

    public function update(Request $request, $irequest)
    {
        $this->validate($request, [
            'response' => 'present|string',
            'status' => 'required|integer'
        ]);

        $irequest->response = $request->input('response');
        $irequest->status   = $request->input('status');

        if ($request->input('status') == 1)
        {
            $irequest->user->excerpts()->create([
                'type' => 'investment',
                'amount' => $irequest->amount,
                'description' => sprintf('Investment %d', $irequest->user->excerpts()->where('type', 'investment')->count() + 1),
            ]);
        }

        $irequest->save();

        return response("<script>window.close();</script>");
    }
}
