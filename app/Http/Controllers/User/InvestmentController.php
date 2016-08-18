<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Excerpt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Auth::user()->excerpts()->where('type', 'investment')->paginate(25);

        return view('user.investments.index')
            ->with('investments', $investments);
    }

    public function create()
    {
        $description = sprintf('Investimento %s', Auth::user()->excerpts()->where('type', 'investment')->count() + 1);

        return view('user.irequests.create')
            ->with('user', \Auth::user())
            ->with('description', $description);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'receipt' => 'required|image',
            'amount' => 'required|digits_between:3,15'
        ]);

        \Storage::makeDirectory('receipts/' . \Auth::user()->username);

        $new_receipt = $request->file('receipt')->move($this->get_receipt_dir(), sprintf("%d.%s", time(), $request->file('receipt')->getClientOriginalExtension()));

        \Auth::user()->investment_requests()->create([
            'amount' => $request->input('amount') / 100,
            'receipt_path' => \Auth::user()->username . '/' . $new_receipt->getBasename(),
            'description' => $request->input('description')
        ]);

        return redirect()->route('user.investments.index');
    }
}
