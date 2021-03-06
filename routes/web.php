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

	// Forums Route
	Route::group(['prefix'=>'forum'], function()
	{
		// Forum Index Route
		Route::get('', 'ForumsController@index')->name('forum.index')->middleware('admin');
		// Forum Create Route
		Route::get('create', 'ForumsController@create')->name('forum.create')->middleware('admin');
		// Forum Register Route
		Route::post('store', 'ForumsController@store')->name('forum.store')->middleware('admin');
		// Forum Register Route
		Route::get('{id}/edit', 'ForumsController@edit')->name('forum.edit')->middleware('admin');
		// Forum Update Route
		Route::put('{id}/update', 'ForumsController@update')->name('forum.update')->middleware('admin');
		// Forum Delete Route
		Route::get('{id}/destroy', 'ForumsController@destroy')->name('forum.destroy')->middleware('admin');
		// Forum Show Route
		Route::get('{id}/show', 'ForumsController@show')->name('forum.show');
	});

	// Question API Routes
	Route::group(['prefix'=>'api/question', 'namespace'=>'Api'], function()
	{
		// GET
		Route::get('', 'QuestionsController@index');
		// POST
		Route::post('', 'QuestionsController@store')->middleware('admin');
		// PUT
		Route::put('{id}', 'QuestionsController@update')->middleware('admin');
		// DELETE
		Route::delete('{id}', 'QuestionsController@destroy')->middleware('admin');
	});

	// Answer API Routes
	Route::group(['prefix'=>'api/answer', 'namespace'=>'Api'], function()
	{
		// GET
		Route::get('{id}', 'AnswersController@index');
		// POST
		Route::post('', 'AnswersController@store');
		// PUT
		Route::put('{id}', 'AnswersController@update');
		// DELETE
		Route::delete('{id}', 'AnswersController@destroy');
	});

});


