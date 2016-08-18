<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = \App\User::orderBy('id', 'asc');

        if ($request->has('s')) {
            $users->where('username', 'LIKE', '%' . $request->input('s') . '%')
                ->orWhere('name', 'LIKE', '%' . $request->input('s') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->input('s') . '%');
        }

        return view('admin.users.index')
            ->with('users', $users->paginate(25));
    }

    public function showUserForm($id)
    {
        return view('admin.updateuser')
            ->with('usr', \App\User::find($id));
    }

    public function user(Request $request, $id)
    {
        $user = \App\User::find($id);

        // TODO: Validate!
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'confirmed',
            'balance' => 'required|digits_between:3,15',
            'e_funds' => 'required|digits_between:3,15',
            'num_quotas' => 'required|integer',
        ]);

        $user->username    = $request->input('username');
        $user->email       = $request->input('email');
        $user->name        = $request->input('name');
        $user->referred_by = $request->input('referred_by');
        $user->active      = $request->has('active') ? true : false;
        $user->confirmed   = $request->has('confirmed') ? true : false;

        if ($request->input('password') != '')
        {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->has('critical-change'))
        {
            $user->balance    = $request->input('balance') / 100;
            $user->e_funds    = $request->input('e_funds') / 100;
            $user->num_quotas = $request->input('num_quotas');
        }

        $user->save();

        return redirect()->route('admin::users');
    }
}
