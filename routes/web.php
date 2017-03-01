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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
    	return view('layouts.template');
	});

	Route::get('/dashboard','DashboardController@index');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

	//Roles
	Route::get('/roles','RolesController@index');

	//Modules
	Route::get('/modules','ModulesController@index');
	Route::get('/modules/{id}','ModulesController@edit');
	Route::post('/modules/','ModulesController@save');
	Route::delete('/modules/{id}','ModulesController@delete');
});


