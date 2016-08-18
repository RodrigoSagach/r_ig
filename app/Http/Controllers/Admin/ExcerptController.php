<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Excerpt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExcerptController extends Controller
{
    public function index()
    {
        $excerpts = Excerpt::orderBy('id', 'DESC')->paginate(25);

        return view('admin.excerpts.index')
            ->with('excerpts', $excerpts);
    }
}
