<?php

namespace App\Admin;

use Route;

class App
{
    public function routes($prefix='admin')
    {
        Route::group(['prefix' => $prefix, 'middleware' => ['auth', 'check-admin', 'https'], 'namespace' => 'Admin'], function () {
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
