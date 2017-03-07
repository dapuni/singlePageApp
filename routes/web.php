<?php
use App\roles;
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
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
    	$roles = roles::find(Auth::user()->role_id);
    	$data['lists'] = DB::table('modules')->whereIn('id',explode(',',$roles->module))->orderby('ordered','ASC')->get();
    	return view('layouts.template',$data);
	});

	Route::get('/dashboard','DashboardController@index');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::group(['middleware' => 'module'], function () {
		//Users
		Route::get('/users','UsersController@index');
		Route::get('/users/{id}','UsersController@edit');
		Route::post('/users','UsersController@save');
		Route::delete('/users/{id}','UsersController@delete');

		//Roles
		Route::get('/roles','RolesController@index');
		Route::get('/roles/{id}','RolesController@edit');
		Route::post('/roles','RolesController@save');
		Route::delete('/roles/{id}','RolesController@delete');

		//Modules
		Route::get('/modules','ModulesController@index');
		Route::get('/modules/{id}','ModulesController@edit');
		Route::post('/modules/','ModulesController@save');
		Route::delete('/modules/{id}','ModulesController@delete');
	});
});


