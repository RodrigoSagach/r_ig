<?php

namespace App\Admin;

use Route;

class App
{
    protected $_domain = '';

    public function __construct()
    {
        $this->_domain = config('app.domain');
    }

    public function routes($prefix='admin')
    {
        $this->_domain = sprintf("%s.%s", $prefix, $this->_domain);

        Route::group(['domain' => $this->_domain, 'middleware' => ['auth', 'check-admin'], 'namespace' => 'Admin'], function () {
            Route::get('/',                         'DashboardController@index');
            Route::get('investments/requests',      'InvestmentRequestController@index');
            Route::get('investments/requests/{id}', 'InvestmentRequestController@show');
            Route::get('withdrawals/requests',      'WithdrawalRequestController@index');
            Route::get('withdrawals/requests/{id}', 'WithdrawalRequestController@show');
            Route::get('excerpts',                  'ExcerptController@index');
            Route::get('users',                     'UserController@index');

            Route::post('investments/new',           'InvestmentRequestController@store');
            Route::post('investments/requests/{id}', 'InvestmentRequestController@postStatus');
        });
    }
}
