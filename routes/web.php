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

	// Forum Index Page
	Route::get('home', 'ForumsController@index')->name('forum.index');

});


