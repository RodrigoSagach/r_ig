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
}
