<?php

namespace App\Providers;

use App\Admin\App as AdminApp;
use Illuminate\Support\ServiceProvider;
use Validator;

class AdminAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AdminApp::class, function ($app) {
            return new AdminApp();
        });
    }
}
