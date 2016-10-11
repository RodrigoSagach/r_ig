<?php

namespace App\User;

use App\User;
use Route;

class App
{
    public function routes($prefix='user')
    {
        Route::group(['prefix' => $prefix, 'middleware' => ['auth', 'check-confirmed', 'https'], 'namespace' => 'User'], function () {
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
