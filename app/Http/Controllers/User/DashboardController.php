<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User\StatsManager;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ParameterBag;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $investments = $user->excerpts()->where('type', 'investment')->orderBy('created_at', 'ASC')->get();
        $earnings = $user->excerpts()->where('type', 'earning')->orderBy('created_at', 'ASC')->get();

        return view('user.index')
            ->with('stats', (new StatsManager(Auth::user()))->getStatsBag())
            ->with('investments', $investments)
            ->with('earnings', $earnings);
    }
}
