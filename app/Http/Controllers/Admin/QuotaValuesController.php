<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\PayDailyUserEarnings;

class QuotaValuesController extends Controller
{
    public function index()
    {
        return view('admin.finances.quotavalues.index')
            ->with('quotavalues', \App\QuotaValue::paginate(15));
    }

    public function create()
    {
        return view('admin.finances.quotavalues.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|digits_between:3,15'
        ]);

        $qvalue = new \App\QuotaValue();
        $qvalue->amount = ($request->input('amount') / 100);
        $qvalue->save();

        $this->dispatch(new PayDailyUserEarnings($qvalue->amount));

        return redirect()->route('admin.finance.quotavalues.index');
    }
}
