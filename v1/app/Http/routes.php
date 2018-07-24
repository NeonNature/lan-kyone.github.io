<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','PageController@index');

Route::post('/','PageController@login');

Route::get('schedule','PageController@schedule');

Route::get('register','PageController@register');

Route::post('register','PageController@registerp');

Route::post('schedule/add','PageController@addpost');

Route::get('viewrequest','PageController@viewrequest');

Route::get('schedule/search','PageController@search');

Route::get('notifications','PageController@notifications');

Route::post('request','PageController@request');

Route::get('profile','PageController@profile');

Route::get('driverschedule','PageController@driverschedule');

Route::post('confirmrequest','PageController@confirm');

Route::get('logout','PageController@logout');