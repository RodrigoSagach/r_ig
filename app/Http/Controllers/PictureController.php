<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\User\InvestmentRequest;

class PictureController extends Controller
{
    public function show($type, $id)
    {
        $base = storage_path('app/pictures');
        $base = sprintf('%s/%s', $base, $type);
        
        $object = null;

        if ($type == 'irequests')
        {
            $object = InvestmentRequest::find($id);
        }

        if ($type == 'profile')
        {
            $object = User::find($id);
        }

        if ($object)
        {
            $path = sprintf('%s/%s', $base, $object->picture_path);

            if (file_exists($path))
            {
                return response(file_get_contents($path))
                    ->header('Content-Type', mime_content_type($path));
            }
        }

        abort(404);
    }
}
