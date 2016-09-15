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

    public function show($wrequest)
    {
        return view('admin.wrequests.show')
            ->with('request', $wrequest);
    }

    public function update(Request $request, $wrequest)
    {
        $this->validate($request, [
            'response' => 'present|string',
            'status' => 'required|integer'
        ]);

        $wrequest->response = $request->input('response');
        $wrequest->status   = $request->input('status');

        if ($request->input('status') == 1)
        {
            $excerpt = $wrequest->user->excerpts()->create([
                'type' => 'withdrawal',
                'description' => sprintf('%s: %s', $wrequest->description, $wrequest->account_value),
                'amount' => $wrequest->amount
            ]);

            $wrequest->excerpt_id = $excerpt->id;
        }

        $wrequest->save();

        return response("<script>window.close();</script>");
    }
}
