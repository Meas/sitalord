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
	/*articles controllers*/

	Route::get('articles', 'ArticlesController@index');
	Route::get('articles/create', 'ArticlesController@create');
	Route::get('articles/edit/{id}', 'ArticlesController@edit');
	Route::get('articles/show/{id}', 'ArticlesController@show');
	Route::get('myarticles', 'ArticlesController@myarticles');
	Route::post('articles/update/{id}', 'ArticlesController@update');
	Route::post('articles/store', 'ArticlesController@store');
	Route::post('articles/delete/{id}', 'ArticlesController@destroy');

	/*slide controllers */
	Route::get('slides', 'SlidesController@index');
	Route::get('slides/select_from_gallery/slide{id}', 'SlidesController@select_from_gallery');
	Route::post('slides/upload/{id}', 'SlidesController@upload');
	Route::get('slides/slide{id}', 'SlidesController@slide_select');
	Route::post('slides/change/slide{id}', 'SlidesController@change');

	Route::get('gallery', 'GalleryController@index');
	Route::post('gallery/upload', 'GalleryController@upload');
	Route::post('gallery/delete/{id}', 'GalleryController@destroy');

	Route::get('documents', 'DocsController@index');
	Route::post('documents/upload', 'DocsController@upload');

	Route::get('/', function () {
    return view('welcome');
});
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
