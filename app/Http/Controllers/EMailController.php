<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mail\ConfirmationEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EMailController extends Controller
{
    public function command($command, $type, $data=null)
    {
        if ($command == 'resend')
        {
            if ($type == 'confirmation')
            {
                $user = User::where('username', $data)->first();

                if (!$user) abort(404);

                Mail::to($user)->send(new ConfirmationEmail($user));

                return back();
            }
        }
        
        abort(404);
    }
}
