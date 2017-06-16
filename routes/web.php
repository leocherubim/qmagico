<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * id variable route validation
 */
Route::pattern('id', '[0-9]+');

/*
|
| Initial Application Route
| It Redirects to login route
|
*/
Route::get('/', function () {
    return redirect('login');
});

/*
|
| Authentication Routes
|
*/
Auth::routes();

Route::group(['middleware'=>'auth'], function()
{

	// Home Application
	Route::get('home', 'ForumsController@home')->name('forum.home');

	Route::group(['prefix'=>'forum'], function()
	{
		// Forum Index Route
		Route::get('', 'ForumsController@index')->name('forum.index');
		// Forum Create Route
		Route::get('create', 'ForumsController@create')->name('forum.create');
		// Forum Register Route
		Route::post('store', 'ForumsController@store')->name('forum.store');
		// Forum Register Route
		Route::get('{id}/edit', 'ForumsController@edit')->name('forum.edit');
		// Forum Update Route
		Route::put('{id}/update', 'ForumsController@update')->name('forum.update');
		// Forum Delete Route
		Route::get('{id}/destroy', 'ForumsController@destroy')->name('forum.destroy');
	});

});


