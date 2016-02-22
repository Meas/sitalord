<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('articles', 'ArticlesController@index');
	Route::get('articles/create', 'ArticlesController@create');
	Route::get('articles/edit/{id}', 'ArticlesController@edit');
	Route::get('articles/show/{id}', 'ArticlesController@show');
	Route::post('articles/update/{id}', 'ArticlesController@update');
	Route::post('articles/store', 'ArticlesController@store');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
