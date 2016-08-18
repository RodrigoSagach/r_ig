<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('register/pending/{username}',     'Auth\RegisterController@pending');
Route::get('register/confirm/{code}',         'Auth\RegisterController@confirm');
Route::get('emails/{command}/{type}/{data?}', 'EMailController@command');

Auth::routes();
\AdminApp::routes();
\UserApp::routes();

Route::get('/',                    'HomeController@home');
Route::get('pictures/{type}/{id}', 'PictureController@show');
