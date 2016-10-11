<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return view('user.profile.show');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'account_type'    => 'required|digits_between:0,1',
            'account_value'   => 'present',
            'password'        => 'confirmed',
            'profile_picture' => 'image',
        ]);

        $user = Auth::user();

        $user->name          = $request->input('name');
        $user->last_name     = $request->input('last_name');
        $user->account_type  = $request->input('account_type');
        $user->account_value = $request->input('account_value');

        if ($request->input('password') != '')
        {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('profile_picture'))
        {
            $base = storage_path('app/pictures/profile/' . $user->username);

            if (!is_dir($base))
                mkdir($base, 0777, true);

            $file = $request->file('profile_picture');

            $new_picture = $file->move($base, sprintf("%d.%s", time(), $file->guessExtension()));

            $user->picture_path = sprintf('%s/%s', $user->username, $new_picture->getBasename());
        }

        $user->save();

        $request->session()->flash('success', true);

        return redirect('user/profile');
    }
}
