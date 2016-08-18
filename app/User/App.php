<?php

namespace App\User;

use App\User;
use Route;

class App
{
    protected $_domain = '';

    public function __construct()
    {
        $this->_domain = config('app.domain');
    }

    public function routes($prefix='user')
    {
        $this->_domain = sprintf("%s.%s", $prefix, $this->_domain);

        Route::group(['domain' => $this->_domain, 'middleware' => ['auth', 'check-confirmed'], 'namespace' => 'User'], function () {
            Route::get('/',                'DashboardController@index');
            Route::get('profile',          'ProfileController@show');
            Route::get('investments',      'InvestmentController@index');
            Route::get('investments/new',  'InvestmentRequestController@create');
            Route::get('investments/{id}', 'InvestmentRequestController@show');
            Route::get('excerpts',         'ExcerptController@index');
            Route::get('withdrawals/new',  'WithdrawalRequestController@create');

            Route::post('profile',         'ProfileController@update');
            Route::post('investments/new', 'InvestmentRequestController@store');
            Route::post('withdrawals/new', 'WithdrawalRequestController@store');
        });
    }
}
