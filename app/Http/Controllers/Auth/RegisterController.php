<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmationEmail;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'  => 'required|unique:users',
            'name'      => 'required|max:255',
            'last_name' => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Mail::to($user)->send(new ConfirmationEmail($user));

        return redirect('register/pending/' . $user->username);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => $data['name'],
            'last_name'         => $data['last_name'],
            'username'          => $data['username'],
            'email'             => $data['email'],
            'confirmation_code' => str_random(30),
            'password'          => bcrypt($data['password']),
        ]);
    }

    public function pending($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) abort(404);

        return view('auth.pending')
            ->with('newUser', $user);
    }

    public function confirm(Request $request, $code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if (!$user) abort(404);

        $user->confirmed = true;
        $user->save();

        $this->guard()->login($user);

        $request->session()->flash('update_payment_data', true);

        return redirect('/profile');
    }
}
