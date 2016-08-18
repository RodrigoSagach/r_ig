<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExcerptController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $excerpts = $user->excerpts()->paginate(25);

        return view('user.excerpts.index')
            ->with('excerpts', $excerpts);
    }
}
