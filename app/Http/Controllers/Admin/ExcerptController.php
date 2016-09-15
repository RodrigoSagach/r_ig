<?php

namespace App\Http\Controllers\Admin;

use App\Excerpt;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ExcerptController extends Controller
{
    public function index(Request $request)
    {
        $excerpts = Excerpt::orderBy('created_at', 'desc');

        if (!in_array($request->input('type'), ['', 'all']))
        {
            $excerpts->where('type', $request->input('type'));
        }

        if ($request->input('query') != '')
        {
            $excerpts->whereHas('user', function ($q) use ($request) {
                $by    = $request->input('by') == 'match' ? '=' : 'LIKE';
                $query = $request->input('by') == 'match' ? $request->input('query') : '%' . $request->input('query') . '%';

                $q->where($request->input('for'), $by, $query);
            });
        }

        return view('admin.excerpts.index', $request->all())
            ->with('excerpts', $excerpts->paginate(25));
    }
}
