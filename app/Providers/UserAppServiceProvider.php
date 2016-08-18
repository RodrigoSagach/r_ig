<?php

namespace App\Providers;

use Auth;
use App\User\App as UserApp;
use Illuminate\Support\ServiceProvider;
use Validator;

class UserAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Hooks/Events used to update the `balance` user field according */
        \App\Excerpt::created(function ($excerpt) {
            if ($excerpt->type == "earning")
            {
                $excerpt->user->balance += $excerpt->amount;
                $excerpt->user->save();
            }
            if ($excerpt->type == "withdrawal")
            {
                $excerpt->user->balance -= $excerpt->amount;
                $excerpt->user->save();
            }
        });

        Validator::extend('balance', function($attribute, $value, $parameters, $validator) {
            return floatval($value) <= Auth::user()->balance;
        });

        Validator::extend('money_amount', function($attribute, $value, $parameters, $validator) {
            if (!preg_match('/[0-9]+(\.[0-9]+)?/', $value))
                return false;

            if (count($parameters) == 1)
            {
                if (floatval($value) < floatval($parameters[0]))
                    return false;
            }

            return true;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserApp::class, function ($app) {
            return new UserApp();
        });
    }
}
