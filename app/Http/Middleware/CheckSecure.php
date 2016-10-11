<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Redirect;
use Request;

class CheckSecure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment('production'))
        {
            if (!Request::secure())
            {
                return Redirect::secure(Request::path());
            }
        }

        return $next($request);
    }
}
