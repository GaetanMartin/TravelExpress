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
 * Internationalization
 * Define a group that filter all pages that must be localized
 */
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

	// Routes for authentication
	Auth::routes();
	// Added get request to log out (only post by default)
	Route::get('/logout' , 'Auth\LoginController@logout');

	// Home
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', function(){
		return redirect('home');
	});


	// Travel Express specific routes
	Route::get('/trip', 'TravelExpress\CarsController@store');
});