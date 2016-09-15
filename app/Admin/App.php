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
            Route::get('/',                                'DashboardController@index');
            Route::get('investments/requests',             'InvestmentRequestController@index');
            Route::get('investments/requests/{irequest}',  'InvestmentRequestController@show');
            Route::get('withdrawals/requests',             'WithdrawalRequestController@index');
            Route::get('withdrawals/requests/{wrequest}',  'WithdrawalRequestController@show');
            Route::get('excerpts',                         'ExcerptController@index');
            Route::get('users',                            'UserController@index');
            Route::get('users/{user}',                     'UserController@edit');

            Route::post('investments/new',                 'InvestmentRequestController@store');

            Route::put('investments/requests/{irequest}',  'InvestmentRequestController@update');
            Route::put('withdrawals/requests/{wrequest}',  'WithdrawalRequestController@update');
            Route::put('users/{user}',                     'UserController@update');

            Route::delete('users/{user}',                  'UserController@destroy');
        });
    }
}
