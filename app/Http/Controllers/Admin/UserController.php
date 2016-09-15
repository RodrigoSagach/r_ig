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
        $users = User::orderBy('created_at', 'desc');

        return view('admin.users.index')
            ->with('users', $users->paginate(25));
    }

    public function edit($user)
    {
        return view('admin.users.edit')->with('editUser', $user);
    }

    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'username'     => 'required|min:6',
            'email'        => 'required|email',
            'password'     => 'confirmed',
            'account_type' => 'required|digits_between:0,1',
        ]);

        $user->username      = $request->input('username');
        $user->email         = $request->input('email');
        $user->name          = $request->input('name');
        $user->last_name     = $request->input('last_name');
        $user->account_type  = $request->input('account_type');
        $user->account_value = $request->input('account_value');
        $user->confirmed     = $request->has('confirmed') ? true : false;

        if ($request->input('password') != '')
        {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        $request->session()->flash('updated', true);

        return back();
    }

    public function destroy($user)
    {
        $user->delete();

        return response()->json(['success' => true]);
    }
}
